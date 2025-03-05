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
use App\Model\Log;
use App\Repositories\Provider\ProviderRepositoryInterface;
use App\Repositories\PaymentMethod\PaymentMethodRepositoryInterface;
use App\Repositories\Payment\PaymentRepositoryInterface;
use App\Repositories\User\UserRepositoryInterface;
use App\Repositories\BankAccount\BankAccountRepositoryInterface;
use App\Repositories\CashFlow\CashFlowRepositoryInterface;

class LogController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
      $level = $request->search_type;
      $search = $request->search;
      $items = Log::orderBy('id', 'desc')->when(!empty($request->search_type), function ($q) use ($level) {
        return $q->where('level', $level);
      })
      ->when(!empty($request->search), function ($q) use ($search) {
        return $q->where('description', 'like', '%'.$search.'%');
      })->orderBy('updated_at', 'desc')->paginate(50);
      return view('admin-view.logs.index', compact('items'));
    }

    public function editView($id){
      $info = Log::find($id);
      $viewRender = view('admin-view.logs.info', compact('info'))->render();
      return response()->json([
          'content' => $viewRender,
          'title' => 'Edit (' . $info->id . ')',
      ]);
    }
}
