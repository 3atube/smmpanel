<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\User;
use Auth;
use Redirect;
use Route;
use Illuminate\Http\Request;
use DB;
use Hash;
use Validator;
use Mail;
use Session, URL;
use Carbon\Carbon;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

/** All Paypal Details class **/

use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Rest\ApiContext;
// 
use App\Repositories\Provider\ProviderRepositoryInterface;
use App\Repositories\BankAccount\BankAccountRepositoryInterface;
use App\Repositories\User\UserRepositoryInterface;
use App\Repositories\Payment\PaymentRepositoryInterface;
use App\Repositories\CashFlow\CashFlowRepositoryInterface;
use App\Repositories\PaymentMethod\PaymentMethodRepositoryInterface;


class PaymentController extends Controller
{
    protected $bankAccountRepository;
    protected $paymentRepository;
    protected $userRepository;
    protected $cashFlowRepository;
    protected $providerRepository;
    protected $paymentMethodRepository;

    public function __construct(
        PaymentMethodRepositoryInterface $paymentMethodRepository,
        CashFlowRepositoryInterface $cashFlowRepository,
        PaymentRepositoryInterface $paymentRepository,
        UserRepositoryInterface $userRepository,
        ProviderRepositoryInterface $providerRepository,
        BankAccountRepositoryInterface $bankAccountRepository
    ) {
        $this->paymentMethodRepository = $paymentMethodRepository;
        $this->providerRepository = $providerRepository;
        $this->bankAccountRepository = $bankAccountRepository;
        $this->userRepository = $userRepository;
        $this->paymentRepository = $paymentRepository;
        $this->cashFlowRepository = $cashFlowRepository;

        /** PayPal api context **/
        $paypal_conf = \Config::get('paypal');
        $info = $this->paymentMethodRepository->findMethodGet('paypal');
        if ($info) {
            $method_extras = json_decode($info->method_extras);
            if (!empty($method_extras->paypal_client_id) && !empty($method_extras->paypal_secret)) {
                $this->_api_context = new ApiContext(
                    new OAuthTokenCredential(
                        $method_extras->paypal_client_id,
                        $method_extras->paypal_secret,
                    )
                );
            }
        } else {
            $this->_api_context = new ApiContext(
                new OAuthTokenCredential(
                    $paypal_conf['client_id'],
                    $paypal_conf['secret']
                )
            );
        }

        $this->_api_context->setConfig($paypal_conf['settings']);
    }

    public function payWithpaypal(Request $request)
    {
        // step 1 gan cac bien vao tung product va them 1 phan paypal 
        // step 2 tao ajax de thanh toan paypal -->
        // step 3 khi thanh toan thanh cong thi check giao dich va + credit
        if (!Session::has('pre_url_payment')) {
            Session::put('pre_url_payment', URL::previous());
        }
        $payer = new Payer();
        $payer->setPaymentMethod('paypal');
        $item_1 = new Item();
        $money = $request->money;
        $name = $request->name;
        $user_id = $request->user_id;
        $user = $this->userRepository->find($user_id);
        // neu khong phai product thi redirect ve trang cu

        if (!($user)) {
            return Redirect::to(URL::previous());
        }
        Session::put('user_id', $user_id);
        Session::put('amount', $money);

        $item_1->setName($name)
            /** item name **/
            ->setCurrency('USD')
            ->setQuantity(1)
            ->setPrice($money);
        /** unit price **/

        $item_list = new ItemList();
        $item_list->setItems(array($item_1));

        $amount = new Amount();
        $amount->setCurrency('USD')
            ->setTotal($money);

        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setItemList($item_list)
            ->setDescription('Your transaction description');

        $redirect_urls = new RedirectUrls();
        $redirect_urls->setReturnUrl(route('paypal.status'))
            /** Specify return URL **/
            ->setCancelUrl(route('paypal.status'));

        $payment = new Payment();
        $payment->setIntent('Sale')
            ->setPayer($payer)
            ->setRedirectUrls($redirect_urls)
            ->setTransactions(array($transaction));
        /** dd($payment->create($this->_api_context));exit; **/
        try {

            $payment->create($this->_api_context);
        } catch (\PayPal\Exception\PPConnectionException $ex) {

            if (\Config::get('app.debug')) {

                \Session::put('error', 'Connection timeout');
                return Redirect::to('/');
            } else {

                \Session::put('error', 'Some error occur, sorry for inconvenient');
                return Redirect::to('/');
            }
        }

        foreach ($payment->getLinks() as $link) {

            if ($link->getRel() == 'approval_url') {

                $redirect_url = $link->getHref();
                break;
            }
        }

        /** add payment ID to session **/
        Session::put('paypal_payment_id', $payment->getId());
        if (isset($redirect_url)) {

            /** redirect to paypal **/
            return Redirect::away($redirect_url);
        }

        \Session::put('error', 'Unknown error occurred');
        return Redirect::to('/');
    }

    // cap nhat trang thai 
    public function getPaymentStatus(Request $request)
    {
        /** Get the payment ID before session clear **/
        $payment_id = Session::get('paypal_payment_id');
        if (!empty($payment_id)) {
            /** clear the session payment ID **/
            Session::forget('paypal_payment_id');
            if (empty($request->PayerID) || empty($request->token)) {

                \Session::put('error', 'Payment failed');
                return Redirect::to('/');
            }
            $payment = Payment::get($payment_id, $this->_api_context);
            $execution = new PaymentExecution();
            $execution->setPayerId($request->PayerID);

            /**Execute the payment **/
            $result = $payment->execute($execution, $this->_api_context);
            if ($result->getState() == 'approved') {
                // neu status la thanh cong thi + credit va tra ve session thanh cong ngoai trang truoc do

                // lay cac bien
                $pre_url_payment = Session::get('pre_url_payment');
                $user_id = Session::get('user_id');
                $amount = Session::get('amount');
                $user = $this->userRepository->find($user_id);
                if ($user) {
                    $user_id = $user->id;
                    // fee
                    $fee = round(($amount*0.044+0.3)*1000)/1000;
                    $amountNew = $amount-$fee;
                    $params = [
                        'payment_status' => 3,
                        'payment_delivery' => 2,
                        'payment_mode' => 'Otomatik',
                        'user_balance' => $user->balance,
                        'payment_method' => 17,
                        'payment_ip' => @$_SERVER['REMOTE_ADDR'],
                        'payment_extra' => '',
                        'payment_bank' => 0,
                        'payment_create_date' => date("Y-m-d H:i:s"),
                        'payment_amount' => $amountNew,
                        'payment_note' => $request->note ? $request->note : "",
                        'user_id' => $user_id,
                        'client_balance' => $user->balance,
                    ];
                    $this->paymentRepository->create($params);
                    $user->update(['balance' => $amountNew + $user->balance]);
                    $this->cashFlowRepository->create([
                        'user_id' => $user_id,
                        'order_id' => 0,
                        'type'  => 'DEPOSIT',
                        'total_cash' => $user->balance,
                        'cash' => '+' . $amountNew.', fee '.$fee.'$'
                    ]);
                    \Session::put('payment_success', 'Payment success + ' . $amountNew . '$');
                    return redirect()->route('addfunds')->with(['proceed' => 'Payment success + ' . $amountNew . '$']);
                } else {
                    return redirect()->route('addfunds')->with(['payment_error' => 'Not found user']);
                }
                \Session::put('success', 'Payment success');
                //xoa session cu
                \Session::flush();
                Session::forget('pre_url_payment');
                Session::forget('user_id');
                Session::forget('amount');
                return Redirect::to($pre_url_payment);
            }

            \Session::put('error', 'Payment failed');
            return Redirect::to('/');
        } else {
        }
    }

    public function bank()
    {
        return view('front-end.payment.bank');
    }

    public function momo()
    {
        return view('front-end.payment.momo');
    }

    public function card()
    {
        return view('front-end.payment.card');
    }

    
}
