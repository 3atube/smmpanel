<?php
 
namespace App\Http\Controllers;
use Socialite, Redirect, URL, File;
use App\Libraries\Helpers;
use App\User; 
use App\Model\MessageTelegram;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class FacebookAuthController extends Controller
{
    public function redirectToProvider()
    {
        try{
            if(!Session::has('pre_url')){
                Session::put('pre_url', URL::previous());
            }else{
                if(URL::previous() != URL::to('login')) Session::put('pre_url', URL::previous());
            }
            return Socialite::driver('facebook')->redirect();
        }catch (\Exception $e) {
            return redirect()->route('registerCustomer');
        }
    }
 
    /**
     * Obtain the user information from facebook.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback()
    {
        try{
            $user = Socialite::driver('facebook')->user();

            $authUser = $this->findOrCreateUser($user);
            
            // Chỗ này để check xem nó có chạy hay không
            // dd($user);
            auth()->login($authUser, true); 

            return redirect()->route('index');
        }catch (\Exception $e) {
            return redirect()->route('registerCustomer');
        }
    }
 
    private function findOrCreateUser($facebookUser){
        try{
            $authUser = User::where('provider_id', $facebookUser->id)->first();
            if($authUser){
                return $authUser;
            }
            if ($facebookUser->email != '') {
                $email = $facebookUser->email;
            } else{
                $email = $facebookUser->id.'@gmail.com';
            }
            $username = str_replace(' ', '', Helpers::remove_accents($facebookUser->name));
            $username = strtolower($username.rand(0,10000));
            $check_email = User::where('email', $email)->first();
            if($check_email){
                return $authUser;
            }else{
                $datetime_now=date('Y-m-d H:i:s');
                $datetime_convert=strtotime($datetime_now);
                $avatar = file_get_contents($facebookUser->getAvatar());
                File::put(base_path() . '/images/avatar/' ."avatar-".$datetime_convert.'-'.$facebookUser->getId().".jpg", $avatar);
                $name_avatar = "avatar-".$datetime_convert.'-'.$facebookUser->getId().".jpg";
                $result = User::create([
                    'name' => $facebookUser->name,
                    'password' => bcrypt($facebookUser->token),
                    'username' => $username,
                    'avatar' => $name_avatar,
                    'email' => $email,
                    'provider_id' => $facebookUser->id,
                    'provider' => $facebookUser->id,
                ]);
                $time_current = date('H:i d/m/Y');
                                // gui thong bao telegram
                $send_info = [];
                $send_info[] = 'Thời gian : '.$time_current."\n\r";
                $send_info[] = 'Kiểu đăng ký : Facebook'."\n\r";
                $send_info[] = 'Email facebook : '.$email."\n\r";
                $send_info[] = 'Username facebook: '.$facebookUser->name."\n\r";
                $message =  implode('',$send_info);
                $params = array(
                    'brand_id' => $result->id, 
                    'channel'=>-1001361527304,
                    'message'=>$message,
                    'type'=>'create_user_facebook',
                    'status'=>'pending',
                );
                    $first = MessageTelegram::where('brand_id',$result->id)->where('channel',-1001361527304)->where('type','create_user_zalo')->first();
                    if(!$first):
                        $info_telegram = MessageTelegram::create($params);
                        // step 3: gui thong bao
                        //https://api.telegram.org/bot880708646:AAEQtZQld2Wh18nypnq8ScKthwaARxDOxJM/sendMessage?chat_id=-1001420856711&text=xong%20nha
                        $token = '1399599604:AAGx-XbCHyJ3dQVpfYDVjZEgcd5TO4g5TBQ';
                        $data = [
                            'text' => $info_telegram->message,
                            'chat_id' => $info_telegram->channel
                        ];
                        @file_get_contents("https://api.telegram.org/bot$token/sendMessage?" . http_build_query($data) );
                        // cap nhat trang thai
                        $info_telegram->update(['status'=>'finish']);
                    endif;
                return $result;
            }
        }catch (\Exception $e) {
            return redirect()->route('registerCustomer');
        }
    }
}