<?php

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use Socialite;
use App\User;
use Illuminate\Support\Facades\Session;
use URL;
use App\Model\MessageTelegram;
use App\Customer,Redirect;
// $path = public_path('/zalo/zalo-php-sdk/vendor/autoload.php');
//  require_once str_replace('public/zalo', 'zalo', $path);
 use Zalo\Zalo;
// require_once __DIR__ . '/zalo/zalo-php-sdk/vendor/autoload.php';

class LoginZaloController extends Controller
{
    public function index()
    {
        try{
            if(auth()->check()){
                if(auth()->user()->type == config('theonhacai.user_type.customer')){
                    return redirect()->route('customer.package.info');
                }else{
                    // return redirect()->route('match.list');
                }
            }
            return view('auth.login_facebook');
        }catch (\Exception $e) {
            return redirect()->route('registerCustomer');
        }
    }
    public function login_zalo(){
        try{
            $config = array(
                'app_id' => '3701872708734977898',
                'app_secret' => 'b5HBf5u4HZxW3XuUMfDS',
                'callback_url' =>URL::to('dang-nhap/zalo/callback')
            );
            $zalo = new Zalo($config);
            $helper = $zalo->getRedirectLoginHelper();
            $callbackUrl =URL::to('dang-nhap/zalo/callback');
            $loginUrl = $helper->getLoginUrl(@$callBackUrl).'&redirect_uri=https://chowordpress.com/dang-nhap/zalo/callback&state=1'; // This is login url
            
        
            return Redirect($loginUrl);
        }catch (\Exception $e) {
            return redirect()->route('registerCustomer');
        }
    }
    public function callback_zalo(){
        try{
            $config = array(
            'app_id' => '3701872708734977898',
                'app_secret' => 'b5HBf5u4HZxW3XuUMfDS',
                'callback_url' => URL::to('dang-nhap/zalo/callback')
            );
            $callbackUrl = URL::to('dang-nhap/zalo/callback');

            $zalo = new Zalo($config);
            $helper = $zalo->getRedirectLoginHelper();
            $oauthCode = isset($_GET['code']) ? $_GET['code'] : "THIS NOT CALLBACK PAGE !!!"; // get oauthoauth code from url params
            $accessToken = $helper->getAccessToken(@$callBackUrl); // get access token
            if ($accessToken != null) {
                $expires = $accessToken->getExpiresAt(); // get expires time
            }
            $params = ['fields' => 'id,name,birthday,gender,picture'];
            // $response = $zalo->get(ZaloEndpoint::API_GRAPH_ME, $accessToken, $params);
            $url = 'https://graph.zalo.me/v2.0/me?access_token='.$accessToken.'&fields=id,birthday,name,gender,picture';
            // $result = $response->getDecodedBody(); // result
            try {
                $data = @file_get_contents($url);
                $user = json_decode($data);
                if(($user)){
                    $user_name = User::where('provider_id', $user->id)->first();
                    if($user_name){
                        auth()->login($user_name, true);
                        return Redirect::to(URL::to('customer/profile'));
                    }
                    $authUser = User::where('provider_id', $user->id)->first();
                    // neu toan tai rui thi dang nhap
                    if ($authUser) {
                        auth()->login($authUser, true);
                    return redirect()->route('index');
                    }else{
                        $facebook_mail = $user->id . '@zalo.com';
                        $email = $facebook_mail ;
                        // check mail da ton tai trong admmin
                        $authemail = User::where('email', $email)->first();
                        if($authemail){
                            return Redirect::to('/');
                        }
                        
                        $authUser = User::where('provider_id', $user->id)->first();
                        if($authUser){
                            $authUser->provider_id = $user->id;
                            $authUser->save();
                            auth()->login($authUser, true);
                            return redirect()->route('index');
                        }else{
                            $_user = new User();
                            $_user->name = $user->name;
                            $_user->username = $user->name;
                            $_user->email = $email;
                            $_user->password = bcrypt('secret');
                            $_user->provider = 'zalo';
                            $_user->provider_id = $user->id;
                            $_user->avatar = $user->picture->data->url;
                            $_user->save();
                            // gui telegram
                            $time_current = date('H:i d/m/Y');
                                // gui thong bao telegram
                            $send_info = [];
                            $send_info[] = 'Thời gian : '.$time_current."\n\r";
                            $send_info[] = 'Email zalo : '.$_user->email."\n\r";
                            $send_info[] = 'Username zalo: '.$user->name."\n\r";
                            $message =  implode('',$send_info);
                            $params = array(
                                'brand_id' => $_user->id, 
                                'channel'=>-1001361527304,
                                'message'=>$message,
                                'type'=>'create_user_zalo',
                                'status'=>'pending',
                            );
                                $first = MessageTelegram::where('brand_id',$_user->id)->where('channel',-1001361527304)->where('type','create_user_zalo')->first();
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
                            auth()->login($_user, true);
                            return redirect()->route('index');
                        }
                    }
                
                    return view('auth.login_facebook', array(
                        'err' => 'Tài khoản đăng nhâp không hợp lệ.'
                    ));

                }
            }catch (\Exception $e) {
                echo "Lỗi không insert dữ liệu ";
                // Handle the current node list is empty..
            }
        }catch (\Exception $e) {
            return redirect()->route('registerCustomer');
        }
       
    }
    public function access_denied()
    {
        return view('auth.access_denied');
    }

    public function redirectToProvider($provider)
    {
        $fbConf = config('theonhacai.facebook');
        return Socialite::driver($provider)->scopes($fbConf['permission'])->redirect();
    }

    public function handleProviderCallback($provider)
    {
        $user = Socialite::driver($provider)->user();
        if($user) {
            Session::put('fb_user_access_token', (string) $user->token);
            $mail = Customer::where('email', $user->email)->first();
            if(count($mail)>0){
                return Redirect::to(Session::get('pre_url'))->with(['mail_unique'=>'true']); 
            }
            $authUser = User::where('provider_id', $user->id)->first();
            if ($authUser) {
                auth()->login($authUser, true);
				if($authUser->type == config('theonhacai.user_type.customer')){
					return redirect()->route('customer.package.info');
				}else{
					return redirect()->route('match.list');
				}
            }else{
                $email = $user->id . '@facebook.com';
                $authUser = User::where('provider_id', $user->id)->first();
                if($authUser){
                    $authUser->provider_id = $user->id;
                    $authUser->save();
                    auth()->login($authUser, true);
					if($authUser->type == config('theonhacai.user_type.customer')){
						return redirect()->route('customer.package.info');
					}else{
						return redirect()->route('match.list');
					}
                }else{
                    $_user = new User();
                    $_user->name = $user->name;
                    $_user->email = $email;
                    $_user->type = config('theonhacai.user_type.customer');
                    $_user->password = bcrypt('secret');
                    $_user->provider = $provider;
                    $_user->provider_id = $user->id;
                    $_user->status = config('theonhacai.status.active');
                    $_user->author = 1;
                    $_user->editor = 1;
                    $_user->save();

                    auth()->login($_user, true);
					return redirect()->route('customer.package.info');
                }
            }
        }
		
        return view('auth.login_facebook', array(
            'err' => 'Tài khoản đăng nhâp không hợp lệ.'
        ));
    }

    public function logout(){
        auth()->logout();
        return view('auth.login');
    }
}
