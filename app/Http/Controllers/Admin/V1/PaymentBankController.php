<?php

namespace App\Http\Controllers\Admin\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Setting, App\Model\Admin, App\Model\Addtocard;
use Illuminate\Support\Facades\Hash;
use App\Libraries\Helpers;
use Illuminate\Support\Str;
use App\User;
use Auth, DB, File, Image, Redirect, Cache;
use App\Exports\CustomerExport;
use App\Exports\OrderExport;
use Maatwebsite\Excel\Facades\Excel;
use WebService;
use Carbon\Carbon;
use Validator;
use Response;
use App\Model\Provider;
use App\Repositories\Provider\ProviderRepositoryInterface;
use App\Repositories\BankAccount\BankAccountRepositoryInterface;
use App\Repositories\User\UserRepositoryInterface;
use App\Repositories\Payment\PaymentRepositoryInterface;
use App\Repositories\CashFlow\CashFlowRepositoryInterface;


class PaymentBankController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    protected $bankAccountRepository;
    protected $paymentRepository;
    protected $userRepository;
    protected $cashFlowRepository;
    protected $providerRepository;
    public function __construct(CashFlowRepositoryInterface $cashFlowRepository, PaymentRepositoryInterface $paymentRepository, UserRepositoryInterface $userRepository, ProviderRepositoryInterface $providerRepository, BankAccountRepositoryInterface $bankAccountRepository){
        $this->providerRepository = $providerRepository;
        $this->bankAccountRepository = $bankAccountRepository;
        $this->userRepository = $userRepository;
        $this->paymentRepository = $paymentRepository;
        $this->cashFlowRepository = $cashFlowRepository;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function banks(){
        $items = $this->paymentRepository->getPaymentPagi('bank');
       return view('admin-view.banks.list', compact('items'));
    }

    public function addView(){
        $items = $this->bankAccountRepository->getAllBankAccount();
        $viewRender = view('admin-view.banks.add', compact('items'))->render();
        return response()->json([
            'content' => $viewRender,
            'title' => 'Add',
        ]);
    }

    public function store(Request $request){
        $validation_rules = array(
            'username' => 'required|max:255',
            'amount' => 'required|max:255',
        );
        $messages = array(
            'username.required' => 'username cannot be empty',
            'amount.required' => 'amount cannot be empty',
        );
        $validator = Validator::make($request->all(), $validation_rules, $messages);
        if($validator->fails()) {
            return response()->json([
                'm' => $validator->messages(),
                's' => 'error',
                'r' => null,
                't' => "error",
                'time' => 1
            ]);
        }
        $username = $request->username;
        $user = $this->userRepository->getUserByName($username);
        if(!$user){
            return response()->json([
                'm' => (object) ['username' => 'Không có username này'],
                's' => 'error',
                'r' => null,
                't' => "error",
                'time' => 1
            ]);
        }else{
            $user_id = $user->id;
        }
        $amount = $request->amount;
        $newAmount = $amount;
       
        $params = [
            'payment_status' =>3,
            'payment_delivery' =>2,
            'payment_mode' => 'Manuel',
            'payment_method' => 0,
            'payment_ip' => @$_SERVER['REMOTE_ADDR'],
            'payment_extra' => '',
            'payment_bank' => $request->bank,
            'payment_create_date' => date("Y-m-d H:i:s"),
            'payment_amount' => $newAmount,
            'payment_note' => $request->note ? $request->note : "",
            'user_id' => $user_id,
            'client_balance' => $user->balance,
        ];
        $this->paymentRepository->create($params);
        $user->update(['balance'=>$newAmount+$user->balance]);
        $this->cashFlowRepository->create([
            'user_id'=>$user_id,
            'order_id' => 0,
            'type'  => 'DEPOSIT',
            'total_cash' => $user->balance,
            'cash' => '+'.$newAmount
        ]);
        return response()->json([
                'r' => route('admin.payments.bank'),
                'm' => 'Transaction successful',
                's' => 'success',
                't' => "error",
                'time' => 1
            ]);
    }

    public function editView($id){
        $info = $this->providerRepository->find($id);
        $api = Helpers::action(["key" => $info->api_key, "action" => "balance"], $info->api_url, 'urlencoded');
        $type_api = 'urlencoded';
        if($api==false){
            $api = Helpers::action(["key" => $info->api_key, "action" => "balance"], $info->api_url, 'json');
            $type_api = 'json';
        }
        $viewRender = view('admin-view.providers.edit', compact('info' , 'type_api'))->render();
        return response()->json([
            'content' => $viewRender,
            'title' => 'Edit provider('.$info->name.')',
        ]);
    }

    public function update($id, Request $request){
        $info = $this->providerRepository->find($id);
        
        $info->update($request->all());
        return response()->json([
                'r' => route('admin.providers'),
                'm' => 'Update thành công',
                's' => 'success',
                't' => "error",
                'time' => 1
            ]);
    }

    public function destroy($id){
        $this->providerRepository->delete($id);
        return response()->json([
                'r' => route('admin.providers'),
                'm' => 'Xóa thành công',
                's' => 'success',
                't' => "error",
                'time' => 1
            ]);
    }
}
