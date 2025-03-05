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

class SettingController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    private $cashFlowRepository;
    public function __construct(CashFlowRepositoryInterface $cashFlowRepository){
        $this->cashFlowRepository = $cashFlowRepository;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function settings (){
       $info = Setting::find(1);
       return view('admin-view.settings.list', compact('info'));
    }

    public function postSetting (Request $request){
        $info = Setting::find(1);
        $info->update($request->all());
        return redirect()->back();
     }
}
