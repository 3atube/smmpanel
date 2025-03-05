<?php

namespace App\Http\Controllers;

use App\User;
use Route;
use Illuminate\Http\Request;
use DB;
use Input;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Model\Customer_forget_pass_otp;
use App\Model\User_register_email;
use Hash;
use Session;
use Cart;
use Carbon\Carbon;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use App\Model\MessageTelegram;
use App\Repositories\User\UserRepositoryInterface;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    protected $userRepository;
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
        //$this->middleware('auth');
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $view = Auth::check() ? 'order' : 'home';
        return view($view);
    }

    public function registerCustomer()
    {
        return view('frontend.login.register');
    }
    public function createCustomer(Request $rq)
    {
        $validation_rules = array(
            'name' => 'required|max:255|unique:users',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:3|confirmed',
            'g-recaptcha-response'=>'required|recaptcha',
        );
        $messages = array(
            'name.required' => 'Hãy nhập họ của bạn',
            'name.max' => '"Họ" tối đa 255 ký tự',
            'email.required' => 'Hãy nhập vào địa chỉ Email',
            'email.email' => 'Địa chỉ Email không đúng định dạng',
            'email.max' => 'Địa chỉ Email tối đa 255 ký tự',
            'email.unique' => 'Địa chỉ Email đã tồn tại',
            'password.required' => 'Hãy nhập mật khẩu',
            'password.min' => 'Mật khẩu tối thiểu 6 ký tự',
            'password.confirmed' => 'Xác nhận mật khẩu không đúng',
            'g-recaptcha-response.recaptcha' => 'Tôi không phải robot',
        );
        $validator = Validator::make($rq->all(), $validation_rules, $messages);
        if ($validator->fails()) {
            return  Redirect::back()->withErrors($validator);
        }
        $new_cus = new User();
        $new_cus->name = $rq->name;
        $new_cus->email = $rq->email;
        $new_cus->phone = $rq->phone;
        $new_cus->password = bcrypt($rq->password);
        $new_cus->save();
        Auth::login($new_cus);
        return redirect()->route('index');
    }

    public function showLoginForm()
    {
        return view('frontend.login.login');
    }

    public function postLogin(Request $request)
    {
        $validation_rules = array(
            'name' => 'required|max:255',
            'password' => 'required|min:3',
        );

        $messages = array(
            'name.required' => 'Please enter your name',
            'name.max' => '"Name" up to 255 characters',
            'password.required' => 'Please enter password',
            'password.min' => 'Password minimum 6 characters',
        );
        $validator = Validator::make($request->all(), $validation_rules, $messages);
        if ($validator->fails()) {
            return  Redirect::back()->withErrors($validator);
        }
        if ($request->remember == 1) {
            $remember = true;
        } else {
            $remember = false;
        }
        $fieldType = filter_var($request->name, FILTER_VALIDATE_EMAIL) ? 'email' : 'name';
        $login = array($fieldType => $request->name, 'password' => $request->password);
        if (Auth::attempt($login, $remember)) {
            $user = $this->userRepository->findUserLogin($fieldType, $request->name);
            if ($user->user_type == 1) {
                return redirect()->back()->with('status', 'Account Deactive');
            }
            return redirect()->route('index');
        } else {
            return redirect()->back()->with('status', 'Email or Password is incorrect');
        }
    }
    //xử lý quên mật khẩu
    public function forgetPassword()
    {
        return view('customer.auth.forget-password');
    }
    public function actionForgetPassword(Request $rq)
    {
        $user = User::where('email', '=', $rq->email)->first();
        if ($user) {
            session_start();
            $customer_forget_pass_otp = new Customer_forget_pass_otp();
            $customer_forget_pass_otp->email = $rq->email;
            $customer_forget_pass_otp->user_id = $user->id;
            $customer_forget_pass_otp->otp_mail = rand(100000, 999999);
            $customer_forget_pass_otp->status = 0;
            $customer_forget_pass_otp->save();
            $_SESSION["otp_forget"] = $customer_forget_pass_otp->otp_mail;
            $_SESSION["email_forget"] = $customer_forget_pass_otp->email;
            $data = array(
                'email' => $customer_forget_pass_otp->email,
                'otp' => $customer_forget_pass_otp->otp_mail,
                'name' => $user->first_name,
                'created_at' => $customer_forget_pass_otp->created_at,
            );
            Mail::send(
                'email.forget-password.forget-password',
                $data,
                function ($message) use ($data) {
                    $message->from('shop@gmail.com', 'shop');
                    $message->to($data['email'])
                        ->subject($data['otp'] . ' là mã OTP của shop.');
                }
            );
            $time_current = date('H:i d/m/Y');
            // gui thong bao telegram
            $send_info = [];
            $send_info[] = 'Thời gian : ' . $time_current . "\n\r";
            $send_info[] = 'Email đổi pass : ' . $rq->email . "\n\r";
            $message =  implode('', $send_info);
            $params = array(
                'brand_id' => time(),
                'channel' => -1001345176311,
                'message' => $message,
                'type' => 'forget_password',
                'status' => 'pending',
            );
            $first = MessageTelegram::where('brand_id', time())->where('channel', -1001345176311)->where('type', 'forget_password')->first();
            if (!$first) :
                $info_telegram = MessageTelegram::create($params);
                // step 3: gui thong bao
                //https://api.telegram.org/bot880708646:AAEQtZQld2Wh18nypnq8ScKthwaARxDOxJM/sendMessage?chat_id=-1001420856711&text=xong%20nha
                $token = '1399599604:AAGx-XbCHyJ3dQVpfYDVjZEgcd5TO4g5TBQ';
                $data = [
                    'text' => $info_telegram->message,
                    'chat_id' => $info_telegram->channel
                ];
                @file_get_contents("https://api.telegram.org/bot$token/sendMessage?" . http_build_query($data));
                // cap nhat trang thai
                $info_telegram->update(['status' => 'finish']);
            endif;
            return redirect()->route('forgetPassword_step2');
        } else {
            redirect()->back()->withErrors('Email not exist.');
        }
    }

    public function forgetPassword_step2()
    {
        session_start();
        if ((!isset($_SESSION["otp_forget"]) && !isset($_SESSION["email_forget"])) || $_SESSION["otp_forget"] == '' || $_SESSION["email_forget"] == '') {
            session_unset();
            session_destroy();
            return redirect()->route('forgetPassword');
        } else {
            return view('customer.auth.forget-password-step-2');
        }
    }

    public function actionForgetPassword_step2(Request $rq)
    {
        session_start();
        $customer_forget_pass_otp = Customer_forget_pass_otp::where('otp_mail', '=', $rq->otp_mail)
            ->where('otp_mail', '=', $_SESSION["otp_forget"])
            ->where('status', '=', 0)
            ->whereRaw("TIME_TO_SEC('" . Carbon::now() . "') - TIME_TO_SEC(created_at) < 300 ")
            ->first();
        if ($customer_forget_pass_otp) {
            $_SESSION["otp_true"] = 1;
            return redirect()->route('forgetPassword_step3');
        } else {
            return redirect()->back()->withErrors('OTP is not correct.');
        }
    }

    public function forgetPassword_step3()
    {
        session_start();
        if ((!isset($_SESSION["otp_forget"]) && !isset($_SESSION["email_forget"]) && !isset($_SESSION["otp_true"])) || $_SESSION["otp_forget"] == '' || $_SESSION["email_forget"] == '') {
            session_unset();
            session_destroy();
            return redirect()->route('forgetPassword');
        } else {
            return view('customer.auth.forget-password-step-3');
        }
    }

    public function actionForgetPassword_step3(Request $rq)
    {
        session_start();
        $customer_forget_pass_otp = Customer_forget_pass_otp::where('email', '=', $_SESSION["email_forget"])
            ->where('otp_mail', '=', $_SESSION["otp_forget"])
            ->where('status', '=', 0)
            ->first();
        if ($customer_forget_pass_otp) {
            $validator = Validator::make($rq->all(), [
                'new_password'     => 'required|min:6|required_with:confirm_new_password|same:confirm_new_password',
                'confirm_new_password'     => 'required|min:6',
            ]);
            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator);
            }
            $customer = User::where('email', '=', $_SESSION["email_forget"])->first();
            $customer->password = bcrypt($rq->new_password);
            $customer->save();

            $customer_forget_pass_otp->status = 1;
            $customer_forget_pass_otp->save();

            session_unset();
            session_destroy();
            $msg = "Mật khẩu đã được thay đổi.";
            $url =  route('user.login');
            if ($msg) echo "<script language='javascript'>alert('" . $msg . "');</script>";
            echo "<script language='javascript'>document.location.replace('" . $url . "');</script>";
        } else {
            session_unset();
            session_destroy();
            return redirect()->route('forgetPassword');
        }
    }
}
