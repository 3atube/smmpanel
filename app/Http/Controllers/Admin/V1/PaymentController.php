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
use App\Repositories\PaymentMethod\PaymentMethodRepositoryInterface;
use App\Repositories\Payment\PaymentRepositoryInterface;
use App\Repositories\User\UserRepositoryInterface;
use App\Repositories\BankAccount\BankAccountRepositoryInterface;
use App\Repositories\CashFlow\CashFlowRepositoryInterface;

class PaymentController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function payments(Request $request)
    {
        $search = $request->search;
        $search_type = $request->search_type;

        $items = $this->paymentRepository->getPaymentPagi($search, $search_type);
        return view('admin-view.payments.list', compact('items'));
    }

    public function addView()
    {
        $items = $this->paymentMethodRepository->getPaymentMethod();
        $viewRender = view('admin-view.payments.add', compact('items'))->render();
        return response()->json([
            'content' => $viewRender,
            'title' => 'Add new',
        ]);
    }

    public function store(Request $request)
    {
        $validation_rules = array(
            'username' => 'required|max:255',
            'amount' => 'required|max:255',
        );
        $messages = array(
            'username.required' => 'username cannot be empty',
            'amount.required' => 'amount cannot be empty',
        );
        $validator = Validator::make($request->all(), $validation_rules, $messages);
        if ($validator->fails()) {
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
        if (!$user) {
            return response()->json([
                'm' => (object) ['username' => 'Không có username này'],
                's' => 'error',
                'r' => null,
                't' => "error",
                'time' => 1
            ]);
        } else {
            $user_id = $user->id;
        }
        $amount = $request->amount;
        $newAmount = null;
        switch ($request->add_remove) {
            case "add":
                $newAmount = $amount;
                break;

            case "remove":
                $newAmount = -$amount;
                break;

            default:
                $newAmount = $amount;
                break;
        }
        $params = [
            'payment_status' => 3,
            'payment_delivery' => 2,
            'payment_mode' => 'Manuel',
            'user_balance'  => $user->balance,
            'payment_method' => $request->method,
            'payment_ip' => @$_SERVER['REMOTE_ADDR'],
            'payment_extra' => '',
            'payment_bank' => 0,
            'payment_create_date' => date("Y-m-d H:i:s"),
            'payment_amount' => $newAmount,
            'payment_note' => $request->note ? $request->note : "",
            'user_id' => $user_id,
        ];
        $payment =  $this->paymentRepository->create($params);
        if ($payment) {
            $user->update(['balance' => ($newAmount + $user->balance)]);
            $this->cashFlowRepository->create([
                'user_id' => $user_id,
                'order_id' => 0,
                'type'  => 'DEPOSIT',
                'total_cash' => $user->balance,
                'cash' => '+' . $newAmount
            ]);
        }

        return response()->json([
            'r' => route('admin.payments'),
            'm' => 'Transaction successful',
            's' => 'success',
            't' => "error",
            'time' => 1
        ]);
    }

    public function editView($id, $type)
    {
        $info = $this->paymentRepository->find($id);
        $items = $this->paymentMethodRepository->getPaymentMethod();
        $itemsBank = $this->bankAccountRepository->getAllBankAccount();

        $viewRender = view('admin-view.payments.edit', compact('items', 'info', 'type', 'itemsBank'))->render();
        return response()->json([
            'content' => $viewRender,
            'title' => 'Edit',
        ]);
    }

    public function update($id, Request $request)
    {
        $info = $this->paymentRepository->find($id);
        $type = $request->type;
        $info->update($request->all());
        return response()->json([
            'r' => $type == 'bank' ? route('admin.payments.bank') : route('admin.payments'),
            'm' => 'Update thành công',
            's' => 'success',
            't' => "error",
            'time' => 1
        ]);
    }

    public function destroy($id)
    {
        $this->paymentRepository->delete($id);
        return response()->json([
            'r' => route('admin.payments'),
            'm' => 'Xóa thành công',
            's' => 'success',
            't' => "error",
            'time' => 1
        ]);
    }
}
