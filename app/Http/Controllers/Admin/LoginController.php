<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Validator, Redirect, Session;
use App\Repositories\Admin\AdminRepositoryInterface;
use Mail, Log;
use App\Mail\Mail2FaAdmin;

class LoginController extends Controller
{
    protected $adminRepository;
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */

    protected $redirectTo = '/admin';
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct(AdminRepositoryInterface $adminRepository)
    {
        $this->adminRepository = $adminRepository;
        $this->middleware('guest:admin')->except('logout');
    }

    public function guard()
    {
        return Auth::guard('admin');
    }

    public function login(Request $request)
    {
        $validation_rules = array(
            'email' => 'required',
            'password' => 'required|min:3',
            'g-recaptcha-response'=>'required|recaptcha',
        );
        $messages = array(
            'email.required' => 'Please enter your email or name',
            'password.required' => 'Please enter password',
            'password.min' => 'Password minimum 6 characters',
            'g-recaptcha-response.recaptcha' => 'Tôi không phải robot',
        );
        $validator = Validator::make($request->all(), $validation_rules, $messages);
        if ($validator->fails()) {
            return  Redirect::back()->withErrors($validator);
        }
        $fieldType = filter_var($request->email, FILTER_VALIDATE_EMAIL) ? 'email' : 'name';
        $login = array($fieldType => $request->email, 'password' => $request->password);
        if (Auth::guard('admin')->attempt($login)) {
            $email = $request->email;
            // get admin
            $admin = $this->adminRepository->findAdminLogin($fieldType, $email);
            $ipLogin = !empty($_SERVER['HTTP_X_FORWARDED_FOR']) ? @$_SERVER['HTTP_X_FORWARDED_FOR'] : @$_SERVER['REMOTE_ADDR'];
            if(!$admin->send_email) {
                return redirect()->route('admin.clients');
            }else if ($admin->ip_login != $ipLogin) {
                Auth::guard('admin')->logout();
                try{
                    Session::put('email_admin', $admin->email);
                    Session::put('password_admin', $request->password);
                    $code = random_int(10000000, 99999999);
                    $admin->verify_code = $code;
                    $admin->save();
                    // render code and send mail
                    $mailable = new Mail2FaAdmin($email, $code);
                    Mail::to($email)->send($mailable);
                } catch (\Exception $e) {
                    Log::error('admin.confirm: '.$e->getMessage()) ;   
                }
                return redirect()->route('admin.confirm');
            }else{
                return redirect()->route('admin.clients');
            }
            // check ip
        } else {
            return redirect()->back()->with('status', 'Email or Password is incorrect');
        }
    }

    public function showLoginForm()
    {
        return view('admin-view.login');
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }
}
