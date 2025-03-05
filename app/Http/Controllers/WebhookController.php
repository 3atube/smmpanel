<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Repositories\Affiliate\AffiliateRepositoryInterface;
use App\Model\WebhookLog;
use App\Repositories\Provider\ProviderRepositoryInterface;
use App\Repositories\PaymentMethod\PaymentMethodRepositoryInterface;
use App\Repositories\Payment\PaymentRepositoryInterface;
use App\Repositories\User\UserRepositoryInterface;
use App\Repositories\BankAccount\BankAccountRepositoryInterface;
use App\Repositories\CashFlow\CashFlowRepositoryInterface;
use App\Libraries\Helpers;
use Artisan;

class WebhookController extends Controller
{
  /**
     * Create a new controller instance.
     *
     * @return void
     */
    protected $userRepository;
    protected $providerRepository;
    protected $bankAccountRepository;
    protected $cashFlowRepository;
    protected $paymentRepository;
    protected $paymentMethodRepository;
    public function __construct(
        BankAccountRepositoryInterface $bankAccountRepository,
        CashFlowRepositoryInterface $cashFlowRepository,
        ProviderRepositoryInterface $providerRepository,
        PaymentMethodRepositoryInterface $paymentMethodRepository,
        PaymentRepositoryInterface $paymentRepository,
        UserRepositoryInterface $userRepository
    ) {
        $this->userRepository = $userRepository;
        $this->providerRepository = $providerRepository;
        $this->bankAccountRepository = $bankAccountRepository;
        $this->paymentMethodRepository = $paymentMethodRepository;
        $this->paymentRepository = $paymentRepository;
        $this->cashFlowRepository = $cashFlowRepository;
        //$this->middleware('auth');
    }
  /**
   * Show the application dashboard.
   *
   * @return \Illuminate\Http\Response
   */
  public function webHookCasso(Request $request)
  {
    Log::info(json_encode($request->all()));
    WebhookLog::updateOrCreate([
      'json' => json_encode($request->all()),
      'type' => 'bank',
    ], [
      'json' => json_encode($request->all()),
      'type' => 'bank',
      'amount' => @($request->data[0])['amount'],
      'description' => @($request->data[0])['description'],
      'header' => json_encode($request->header()),
    ]);
    // $_SERVER['HTTP_SECURE_TOKEN'];
    $key = env('KEY');
    $paymentInfo = Helpers::infoManualPayment(); $methodExtras = json_decode($paymentInfo->method_extras);
    // check key
    if ($request->error == 0 && $request->header('secure-token') == $key) {
      if (count($request->data)) {
        foreach ($request->data as $key => $item) {
          $item = (object) $item;
          try {
            $tranId = $item->id;
            $amount = $item->amount;
            $comment = $item->description;
            $cusumBalance = $item->cusum_balance;
            if (!empty($comment)) {
              $content = strtolower($comment);
              if (strpos($content, $methodExtras->merchant_website) !== false) {
                $userArr = explode($methodExtras->merchant_website." ", $content);
                if (count($userArr) > 0) {
                  $userName = $userArr[1];
                  if (strpos($userArr[0], 'mbvcb') !== false) {
                    $userNameArr = explode('ct', $userName);
                    $userName = str_replace(' ', '', $userNameArr[0]);
                    $userName = str_replace('.ct tu', '', $userName);
                    $userName = str_replace('.', '', $userName);
                  }
                  // NAPTIEN NGUYENHOANGPHUC-230523-13:21:16 060999; tai Napas
                  if(strpos($userName, '-') !== false) {
                    $arr = explode('-', $userName);
                    $userName = @$arr[0];
                  }
                  Log::info('Username:' . $userName);
                  $userNameArr = explode(' ', $userName);
                  foreach ($userNameArr as $username) {
                    if (trim($userArr[0]) == 'mb') {
                      $username =  str_replace('.', '', $username);
                    }
                    $username =  str_replace('.', '', $username);
                    $username =  str_replace(';', '', $username);
                    $username =  str_replace(',', '', $username);
                    $user = $this->userRepository->getUserByName($username);
                    if ($user) {
                        $user_id = $user->id;
                        $amountNext = round(($amount / env('RATE')) * 1000) / 1000;
                        $newAmount = $amountNext;
                        $payment_method = 18;
                        $tranId = str_replace('\BNK', '',  $tranId);
                        $tranId = str_replace('\BNK', '',  $tranId);
                        $tranId = (int) str_replace('FT', '',  $tranId);

                        $params = [
                            'payment_privatecode' => $tranId,
                            'payment_status' => 3,
                            'payment_delivery' => 2,
                            'payment_mode' => 'Otomatik',
                            'payment_method' => $payment_method,
                            'payment_ip' => !empty($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : "admin 172.70.93.37",
                            'payment_extra' => '',
                            'payment_bank' => 0,
                            'payment_create_date' => date("Y-m-d H:i:s"),
                            'payment_amount' => $newAmount,
                            'payment_note' => $tranId,
                            'user_id' => $user_id,
                            'user_balance' => $user->balance,
                        ];
                        $transaction = $this->paymentRepository->findTranId($tranId);
                        if (!$transaction) {
                            $payment =  $this->paymentRepository->create($params);
                            if ($payment) {
                                $paramsUser = ['balance' => ($newAmount + $user->balance)];
                                $user->update($paramsUser);
                                $this->cashFlowRepository->create([
                                    'user_id' => $user_id,
                                    'order_id' => 0,
                                    'type'  => 'DEPOSIT',
                                    'payment_method' => $payment_method,
                                    'total_cash' => $user->balance,
                                    'cash' => '+' . $newAmount
                                ]);
                            }
                            Log::info(json_encode($params));
                            Log::info(json_encode($paramsUser));
                        } else {
                            if (empty($transaction->payment_note)) {
                                $transaction->update(['payment_note' => $tranId]);
                            }
                        }
                    }
                    break;
                  }
                } else {
                  Log::info('count($userArr) params:' . json_encode($request->all()));
                }
              } else {
                Log::info('Noi dung tin nhan:' . $comment);
              }
            }
          } catch (\Exception $e) {
            Log::debug('Payment Bank: ' . $e->getMessage());
            Log::debug('Payment request all: ' . json_encode($request->all()));
          }
        }
      }
    }
  }

  public function addPayment($username, $amount)
  {
    try{
      $curl = curl_init();
      curl_setopt_array($curl, array(
        CURLOPT_URL => env('URLAPI'),
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => array('key' => env('ADMINAPI'), 'action' => 'addpayment', 'username' => $username, 'amount' => $amount, 'details' => ''),
      ));
  
      $response = curl_exec($curl);
  
      curl_close($curl);
      return $response;
    } catch (\Exception $e) {
      Log::debug('addPayment: ' . $e->getMessage());
    }
  }
}
