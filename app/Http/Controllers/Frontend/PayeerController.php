<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\User;
use Auth;
use Redirect;
use Route;
use Illuminate\Http\Request;
use DB;
use Input;
use Hash;
use Validator;
use Mail;
use Session;
use Carbon\Carbon;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

/** All Paypal Details class **/

use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Rest\ApiContext;
use Log;
use App\Repositories\Provider\ProviderRepositoryInterface;
use App\Repositories\PaymentMethod\PaymentMethodRepositoryInterface;
use App\Repositories\Payment\PaymentRepositoryInterface;
use App\Repositories\User\UserRepositoryInterface;
use App\Repositories\BankAccount\BankAccountRepositoryInterface;
use App\Repositories\CashFlow\CashFlowRepositoryInterface;
// 


class PayeerController extends Controller
{
    protected $providerRepository;
    protected $bankAccountRepository;
    protected $paymentMethodRepository;
    protected $paymentRepository;
    protected $userRepository;
    protected $cashFlowRepository;
    public function __construct(BankAccountRepositoryInterface $bankAccountRepository, CashFlowRepositoryInterface $cashFlowRepository, UserRepositoryInterface $userRepository, ProviderRepositoryInterface $providerRepository, PaymentMethodRepositoryInterface $paymentMethodRepository, PaymentRepositoryInterface $paymentRepository)
    {
        $this->providerRepository = $providerRepository;
        $this->bankAccountRepository = $bankAccountRepository;
        $this->paymentMethodRepository = $paymentMethodRepository;
        $this->paymentRepository = $paymentRepository;
        $this->userRepository = $userRepository;
        $this->cashFlowRepository = $cashFlowRepository;
    }

    public function form(Request $request)
    {
        $info = $this->paymentMethodRepository->findMethodGet('payeer');

        if ($request->m_amount < 1) {
            return response()->json([
                'error' => 'Minimal amount $1.00',
                's' => 'error',
                'r' => null,
                't' => "error",
                'time' => 1
            ]);
        }
        // Merchant ID
        if ($info) {
            $method_extras = json_decode($info->method_extras);
            if (!empty($method_extras->merchant_key) && !empty($method_extras->secret_key)) {
                $m_shop = $method_extras->merchant_key;
                $m_key = $method_extras->secret_key;
            }
        } else {
            $m_shop = '1667344001';
            $m_key = '1667344001';
        }
        $m_amount = number_format($request->m_amount, 2, '.', '');
        $m_curr = 'USD';
        $m_desc = base64_encode('Add funds (' . Auth::user()->name . ')');
        // Secret Key
        $user = Auth::user();
        $user_id = $user->id;
        $params = [
            'payment_status' => 1,
            'payment_delivery' => 2,
            'user_balance' => $user->balance,
            'payment_mode' => 'Otomatik',
            'payment_method' => 14,
            'payment_ip' => @$_SERVER['REMOTE_ADDR'],
            'payment_extra' => '',
            'payment_bank' => 0,
            'payment_create_date' => date("Y-m-d H:i:s"),
            'payment_amount' => $request->m_amount,
            'payment_note' => $request->note ? $request->note : "",
            'user_id' => $user_id,
            'client_balance' => $user->balance,
        ];
        $order =  $this->paymentRepository->create($params);
        $m_orderid = $order->id;

        $arHash = array(
            $m_shop,
            $m_orderid,
            $m_amount,
            $m_curr,
            $m_desc
        );
        $arHash[] = $m_key;

        $sign = strtoupper(hash('sha256', implode(':', $arHash)));
        $arr = [
            'm_shop' => $m_shop,
            'm_orderid' => $m_orderid,
            'm_curr' => $m_curr,
            'm_desc' => $m_desc,
            'm_sign' => $sign,
            'm_amount' => $request->m_amount,
        ];
        /** add payment ID to session **/
        Session::put('payeer_sign', $sign);


        $link = 'https://payeer.com/merchant/?' . http_build_query($arr);
        return response()->json([
            'link' => $link,
            's' => 'error',
            'r' => null,
            'success' => true,
            'time' => 1
        ]);
    }
    public function success(Request $request)
    {
        Log::error($request->all());
        $payeer_sign = Session::get('payeer_sign');
        if (!empty($payeer_sign)) {
            try {

                if (@$_SERVER['HTTP_REFERER'] == 'https://payeer.com/') {
                    Session::forget('payeer_sign');

                    if ($request->m_status == 'success') {
                        $m_orderid = $request->m_orderid;
                        $payment = $this->paymentRepository->find($m_orderid);
                        $user = $payment->user;
                        if ($user) {
                            $amount = $request->m_amount;
                            $user_id = $user->id;
                            $params = [
                                'payment_status' => 3,
                                'payment_delivery' => 2,
                                'user_balance' => $user->balance,
                                'payment_mode' => 'Otomatik',
                                'payment_method' => 14,
                                'payment_ip' => @$_SERVER['REMOTE_ADDR'],
                                'payment_extra' => '',
                                'payment_bank' => 0,
                                'payment_create_date' => date("Y-m-d H:i:s"),
                                'payment_amount' => $amount,
                                'payment_note' => $request->note ? $request->note : "",
                                'user_id' => $user_id,
                                'client_balance' => $user->balance,
                            ];
                            $payment->update($params);
                            $user->update(['balance' => $amount + $user->balance]);
                            $this->cashFlowRepository->create([
                                'user_id' => $user_id,
                                'order_id' => 0,
                                'type'  => 'DEPOSIT',
                                'total_cash' => $user->balance,
                                'cash' => '+' . $amount
                            ]);
                            \Session::put('payment_success', 'Payment success + ' . $amount . '$');
                            return redirect()->route('addfunds')->with(['proceed' => 'Payment success + ' . $amount . '$']);
                        } else {
                            return redirect()->route('addfunds')->with(['payment_error' => 'Not found user']);
                        }
                    }
                } else {
                    return redirect()->route('addfunds')->with(['payment_error' => 'Not found payeer']);
                }
            } catch (\Exception $e) {
                Log::error($e->getMessage());
                return redirect()->route('addfunds')->with(['payment_error' => $e->getMessage()]);
            }
        }
    }

    public function status(Request $request){
        Log::info('PayeerController status '.$request->all());

        if (!empty($request)) {
            return response()->json([
                'm' => 'Not found',
                's' => 'error',
                'r' => null,
                't' => "error",
                'time' => 1
            ]);
        }
    }

    public function fail(Request $request)
    {
        $m_orderid = $request->m_orderid;
        $payment = $this->paymentRepository->delete($m_orderid);
        return redirect()->route('addfunds')->with(['payment_error' => 'Payments cancel']);

        if (!empty($request)) {
            return response()->json([
                'm' => 'Not found',
                's' => 'error',
                'r' => null,
                't' => "error",
                'time' => 1
            ]);
        }
    }
}
