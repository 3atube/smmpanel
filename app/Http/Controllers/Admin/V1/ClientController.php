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
use App\Model\CashFlow;
use App\Repositories\CashFlow\CashFlowRepositoryInterface;
use App\Repositories\User\UserRepositoryInterface;
use App\Repositories\Service\ServiceRepositoryInterface;
use App\Repositories\UserPrice\UserPriceRepositoryInterface;

class ClientController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    protected $cashFlowRepository;
    protected $userRepository;
    protected $serviceRepository;
    protected $userPriceRepository;
    public function __construct(
        ServiceRepositoryInterface $serviceRepository,
        CashFlowRepositoryInterface $cashFlowRepository,
        UserRepositoryInterface $userRepository,
        UserPriceRepositoryInterface $userPriceRepository
    ) {
        $this->cashFlowRepository = $cashFlowRepository;
        $this->userRepository = $userRepository;
        $this->serviceRepository = $serviceRepository;
        $this->userPriceRepository = $userPriceRepository;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function clients(Request $request)
    {
        $search = $request->search;
        $search_type = $request->search_type;
        $items = $this->userRepository->getUserPagi($search, $search_type);
        return view('admin-view.clients.list', compact('items'));
    }

    public function checkTotal(Request $request){
        $userId = $request->userId;
        $userIdArr = explode("," , $userId);
        foreach($userIdArr as $userId){
            if(!empty($userId)){
                $order = DB::table('orders')->select(DB::raw('sum(order_charge) as sum'))->where('user_id', $userId )->first();
                $payment = DB::table('payments')->select(DB::raw('sum(payment_amount) as sum'))->where('user_id', $userId )->where('payment_status',3)->first();
                $user = DB::table('users')->where('id', $userId )->first();
                echo 'total order: '.$order->sum."<br>";
                echo 'total payment: '.$payment->sum."<br>";
                echo 'balance user: '.$user->balance."<br>";
                echo floor(( $order->sum - $payment->sum)+ $user->balance)."<br>"; ;
            }
        }
        
    }

    public function deactive($id)
    {
       
        $info = $this->userRepository->find($id);
        $info->update(['user_type' => 1]);
        return redirect()->route('admin.clients');
    }

    public function active($id)
    {
        $info = $this->userRepository->find($id);
        $info->update(['user_type' => 2]);
        return redirect()->route('admin.clients');
    }

    public function addView(){
        $viewRender = view('admin-view.clients.add')->render();
        return response()->json([
            'content' => $viewRender,
            'title' => 'Add new',
        ]);
    }

    public function store(Request $request){
        $validation_rules = array(
            'email' => 'required|max:255',
            'username' => 'required|max:255',
            'password'=> 'required|max:255',
        );
        $messages = array(
            'email.required' => 'email cannot be empty',
            'username.required' => 'username cannot be empty',
            'password.required' => 'password cannot be empty',
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
        $email = $request->email;
        $username = $request->username;
        $phone = $request->telephone;
        
        $balance = 0;
        $params =[
            'email' => $email,
            'name' => $username,
            'password' => bcrypt($request->password),
            'phone'    => $phone,
            'balance'   => $balance,
            'user_type' => 1,
            'spent' => 0,
            'balance_type' => 2,
            'key_api' => null,
            'status' =>1
        ];
        $this->userRepository->create($params);
        return response()->json([
                'r' => route('admin.clients'),
                'm' => 'Transaction successful',
                's' => 'success',
                't' => "error",
                'time' => 1
            ]);
    }

    public function delPrice($id)
    {
        $this->userPriceRepository->deleteServiceUser($id);
        return redirect()->route('admin.clients');
    }

    public function priceUser($id)
    {
        $info = $this->userRepository->find($id);
        $items = $this->serviceRepository->getServiceUserPrice($id);
        $viewRender = view('admin-view.clients.price-user', compact('info', 'items'))->render();
        return response()->json([
            'content' => $viewRender,
            'title' => 'Special Pricing',
        ]);
    }

    public function updatePrice($user_id, Request $request)
    {
        $info = $this->userRepository->find($user_id);
        $prices = $request->price;
        if (!empty($prices)) {
            foreach ($prices as $service_id => $price) {
                if ($price == null) {
                    $this->userPriceRepository->deletePrice($service_id, $user_id);
                } else {
                    $first =  $this->userPriceRepository->findPrice($service_id, $user_id);
                    if ($first) {
                        $first->update(['service_price' => $price]);
                    } else {
                        $this->userPriceRepository->create(['user_id' => $user_id, 'service_id' => $service_id, 'service_price' => $price]);
                    }
                }

                # code...
            }
        }
        return response()->json([
            'r' => route('admin.clients'),
            'm' => 'Transaction successful',
            's' => 'success',
            't' => "error",
            'time' => 1
        ]);
    }

    public function editUser($id)
    {
        $info = $this->userRepository->find($id);
        $viewRender = view('admin-view.clients.edit-user', compact('info'))->render();
        return response()->json([
            'content' => $viewRender,
            'title' => 'Edit user',
        ]);
    }

    public function changeApikey($id)
    {
        $info = $this->userRepository->find($id);
        $random = Str::random(40);
        $info->update(['key_api' => $random]);
        return redirect()->route('admin.clients');
    }

    public function updateUser($id, Request $request)
    {
        $info = $this->userRepository->find($id);
        $info->update($request->all());
        return response()->json([
            'r' => route('admin.clients'),
            'm' => 'Transaction successful',
            's' => 'success',
            't' => "error",
            'time' => 1
        ]);
    }

    public function passUser($id)
    {
        $info = $this->userRepository->find($id);
        $viewRender = view('admin-view.clients.edit-password', compact('info'))->render();
        return response()->json([
            'content' => $viewRender,
            'title' => 'Edit user',
        ]);
    }

    public function updateUserPassword($id, Request $request)
    {
        $info = $this->userRepository->find($id);
        $data = array(
            'password' => bcrypt($request->password)
        );
        $info->update($data);
        return response()->json([
            'r' => route('admin.clients'),
            'm' => 'Transaction successful',
            's' => 'success',
            't' => "error",
            'time' => 1
        ]);
    }
}
