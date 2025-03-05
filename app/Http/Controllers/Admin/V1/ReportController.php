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
use App\Repositories\User\UserRepositoryInterface;

class ReportController extends Controller
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  protected $cashFlowRepository;
  protected $adminRepository;
  protected $serviceRepository;
  protected $userRepository;
  public function __construct(
    ServiceRepositoryInterface $serviceRepository,
    CashFlowRepositoryInterface $cashFlowRepository,
    AdminRepositoryInterface $adminRepository,
    UserRepositoryInterface $userRepository
  ) {
    $this->cashFlowRepository = $cashFlowRepository;
    $this->adminRepository = $adminRepository;
    $this->serviceRepository = $serviceRepository;
    $this->userRepository = $userRepository;
  }

  /**
   * Show the application dashboard.
   *
   * @return \Illuminate\Contracts\Support\Renderable
   */
  public function orders(Request $request, $string)
  {
    $servicesWhere = $request->services ?? [] ;

    $usersWhere = $request->users ?? [] ;
    $statusesWhere = $request->statuses ?? [ 'pending', 'processing', 'inprogress', 'completed', 'partial', 'canceled', 'fail'] ;
    $services = $this->serviceRepository->getAll();
    $users = $this->userRepository->getAll();
    $year = !empty(request()->year) ? request()->year : \Carbon\Carbon::now()->year;
    return view('admin-view.reports.orders.index', compact('string', 'year', 'services', 'users', 'servicesWhere', 'usersWhere', 'statusesWhere'));
  }

  public function quantity(Request $request)
  {
    $year = !empty(request()->year) ? request()->year : \Carbon\Carbon::now()->year;
    return view('admin-view.reports.orders.quantity', compact('year'));
  }
}
