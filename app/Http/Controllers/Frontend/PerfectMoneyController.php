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


class PerfectMoneyController extends Controller
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

    public function success(Request $request)
    {
        try {
            if (@$_SERVER['HTTP_REFERER'] == 'https://perfectmoney.is/') {
                $account_id = $request->ACCOUNT_ID;
                $user = $this->userRepository->find($account_id);
                if ($user) {
                    $amount = $request->PAYMENT_AMOUNT;
                    $user_id = $user->id;
                    $params = [
                        'payment_status' => 3,
                        'payment_delivery' => 2,
                        'user_balance' => $user->balance,
                        'payment_mode' => 'Otomatik',
                        'payment_method' => 16,
                        'payment_ip' => @$_SERVER['REMOTE_ADDR'],
                        'payment_extra' => '',
                        'payment_bank' => 0,
                        'payment_create_date' => date("Y-m-d H:i:s"),
                        'payment_amount' => $amount,
                        'payment_note' => $request->note ? $request->note : "",
                        'user_id' => $user_id,
                        'client_balance' => $user->balance,
                    ];
                    $this->paymentRepository->create($params);
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
            } else {
                return redirect()->route('addfunds')->with(['payment_error' => 'Not found perfectmoney']);
            }
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->route('addfunds')->with(['payment_error' => $e->getMessage()]);
        }
    }

    public function status(Request $request)
    {
        try {
            Log::info('PerfectMoneyController status ' . json_encode($request->all()));

            if (!empty($request)) {
                return response()->json([
                    'm' => 'Not found',
                    's' => 'error',
                    'r' => null,
                    't' => "error",
                    'time' => 1
                ]);
            }
        } catch (\Exception $e) {
            Log::error('PerfectMoneyController status' . $e->getMessage());
            return redirect()->route('addfunds');
        }
    }

    public function fail(Request $request)
    {
        try {
            Log::info('PerfectMoneyController fail ' . json_encode($request->all()));
            if (!empty($request)) {
                return response()->json([
                    'm' => 'Not found',
                    's' => 'error',
                    'r' => null,
                    't' => "error",
                    'time' => 1
                ]);
            }
        } catch (\Exception $e) {
            Log::error('PerfectMoneyController fail' . $e->getMessage());
            return redirect()->route('addfunds');
        }
    }
}
