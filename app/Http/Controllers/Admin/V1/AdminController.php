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
use App\Repositories\Admin\AdminRepositoryInterface;
use App\Repositories\Service\ServiceRepositoryInterface;
use App\Repositories\UserPrice\UserPriceRepositoryInterface;

class AdminController extends Controller
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  protected $cashFlowRepository;
  protected $adminRepository;
  protected $serviceRepository;
  protected $userPriceRepository;
  public function __construct(
    ServiceRepositoryInterface $serviceRepository,
    CashFlowRepositoryInterface $cashFlowRepository,
    AdminRepositoryInterface $adminRepository,
    UserPriceRepositoryInterface $userPriceRepository
  ) {
    $this->cashFlowRepository = $cashFlowRepository;
    $this->adminRepository = $adminRepository;
    $this->serviceRepository = $serviceRepository;
    $this->userPriceRepository = $userPriceRepository;
  }

  /**
   * Show the application dashboard.
   *
   * @return \Illuminate\Contracts\Support\Renderable
   */
  public function index(Request $request)
  {
    $search = $request->search;
    $search_type = $request->search_type;
    $items = $this->adminRepository->getPagi($search, $search_type);
    return view('admin-view.admin.list', compact('items'));
  }

  public function changePass(Request $rq)
  {
    $user = Auth::guard('admin')->user();
    if (Hash::check($rq->current_password, $user->password)) {
      if ($rq->new_password == $rq->confirm_password) {
        $data = array(
          'password' => bcrypt($rq->new_password)
        );
      } else {
        $msg = 'Mật khẩu xác nhận không trùng khớp';
        return Redirect::back()->withErrors($msg);
      }
    } else {
      $msg = 'Mật khẩu hiện tại không chính xác';
      return Redirect::back()->withErrors($msg);
    }
    $respons = $user->update($data);
    $msg = "Mật khẩu đã được thay đổi";
    $url =  route('admin.account');
    Helpers::msg_move_page($msg, $url);
  }

  public function account()
  {
    return view('admin-view.account.change-pass');
  }

  public function destroy($id)
  {
    $this->adminRepository->delete($id);
    return response()->json([
      'r' => route('admin.users'),
      'm' => 'Xóa thành công',
      's' => 'success',
      't' => "error",
      'time' => 1
    ]);
  }

  public function addView()
  {
    $viewRender = view('admin-view.admin.add')->render();
    return response()->json([
      'content' => $viewRender,
      'title' => 'Add new',
    ]);
  }

  public function store(Request $request)
  {
    $validation_rules = array(
      'email' => 'required|max:255',
      'username' => 'required|max:255',
      'password' => 'required|max:255',
    );
    $messages = array(
      'email.required' => 'email cannot be empty',
      'username.required' => 'username cannot be empty',
      'password.required' => 'password cannot be empty',
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
    $email = $request->email;
    $username = $request->username;
    $params = [
      'email' => $email,
      'name' => $username,
      'password' => bcrypt($request->password),
      'admin_level' => 1,
      'count_order' => 1
    ];
    $this->adminRepository->create($params);
    return response()->json([
      'r' => route('admin.users'),
      'm' => 'Transaction successful',
      's' => 'success',
      't' => "error",
      'time' => 1
    ]);
  }

  public function editUser($id)
  {
    $info = $this->adminRepository->find($id);
    $viewRender = view('admin-view.admin.edit-user', compact('info'))->render();
    return response()->json([
      'content' => $viewRender,
      'title' => 'Edit user',
    ]);
  }

  public function updateUser($id, Request $request)
  {
    $info = $this->adminRepository->find($id);
    $info->update($request->all());
    return response()->json([
      'r' => route('admin.users'),
      'm' => 'Transaction successful',
      's' => 'success',
      't' => "error",
      'time' => 1
    ]);
  }

  public function passUser($id)
  {
    $info = $this->adminRepository->find($id);
    $viewRender = view('admin-view.admin.edit-password', compact('info'))->render();
    return response()->json([
      'content' => $viewRender,
      'title' => 'Edit user',
    ]);
  }

  public function updateUserPassword($id, Request $request)
  {
    $info = $this->adminRepository->find($id);
    $data = array(
      'password' => bcrypt($request->password)
    );
    $info->update($data);
    return response()->json([
      'r' => route('admin.users'),
      'm' => 'Transaction successful',
      's' => 'success',
      't' => "error",
      'time' => 1
    ]);
  }
}
