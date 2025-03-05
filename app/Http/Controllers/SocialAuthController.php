<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Socialite, Redirect, URL;
use App\User;
use App\Model\MessageTelegram;
use App\Libraries\Helpers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;


class SocialAuthController extends Controller
{
    /**
     * Chuyển hướng người dùng sang OAuth Provider.
     *
     * @return Response
     */
    public function redirectToProvider($provider)
    {
        try{
            if(!Session::has('pre_url')){
                Session::put('pre_url', URL::previous());
            }else{
                if(URL::previous() != URL::to('login')) Session::put('pre_url', URL::previous());
            }
            return Socialite::driver('google')->redirect();
        }catch (\Exception $e) {
            return redirect()->route('registerCustomer');
        }
    }  

    /**
     * Lấy thông tin từ Provider, kiểm tra nếu người dùng đã tồn tại trong CSDL
     * thì đăng nhập, ngược lại nếu chưa thì tạo người dùng mới trong SCDL.
     *
     * @return Response
     */
    public function handleProviderCallback($provider)
    {
        try{
            $user = Socialite::driver('google')->user();

            $authUser = $this->findOrCreateUser($user,'google');

            auth()->login($authUser, true); 

            return redirect()->route('index');
        }catch (\Exception $e) {
            return redirect()->route('registerCustomer');
        }
    }

    /**
     * @param  $user Socialite user object
     * @param $provider Social auth provider
     * @return  User
     */
    public function findOrCreateUser($user, $provider)
    {
        try{
            $authUser = User::where('provider_id', $user->id)->first();
            if ($authUser) {
                return $authUser;
            }
            if ($user->email != '') {
                $email = $user->email;
            } else{
                $email = $user->id.'@gmail.com';
            }
            $username = str_replace(' ', '', Helpers::remove_accents($user->name));
            $username = strtolower($username.rand(0,10000));
            $check_email = User::where('email', $user->email)->first();
            if($check_email){
                return $authUser;
            }else{
                $result = User::create([
                    'name'     => $user->name,
                    'email'    => $email,
                    'password' => bcrypt($user->token),
                    'username' => $username,
                    'provider' => 'google',
                    'provider_id' => $user->id
                ]);
                $time_current = date('H:i d/m/Y');
                                // gui thong bao telegram
                $send_info = [];
                $send_info[] = 'Thời gian : '.$time_current."\n\r";
                $send_info[] = 'Kiểu đăng ký : Google'."\n\r";
                $send_info[] = 'Email google : '.$email."\n\r";
                $send_info[] = 'Username google: '.$user->name."\n\r";
                $message =  implode('',$send_info);
                $params = array(
                    'brand_id' => $result->id, 
                    'channel'=>-1001361527304,
                    'message'=>$message,
                    'type'=>'create_user_google',
                    'status'=>'pending',
                );
                    $first = MessageTelegram::where('brand_id',$result->id)->where('channel',-1001361527304)->where('type','create_user_google')->first();
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