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

class AjaxController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(CashFlowRepositoryInterface $cashFlowRepository)
    {
        $this->cashFlowRepository = $cashFlowRepository;
    }

    public function viewLog($fileName)
    {
        $path = storage_path('logs/' . $fileName);
        if (file_exists($path)) {
            $test = File::get($path);
            dd($test);
        } else {
            echo 'Empty';
        }
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function ajaxData(Request $request)
    {
        $action = $request->action;
        $id = $request->id;
        switch ($action) {
            case 'new_provider':
                return app('App\Http\Controllers\Admin\V1\ProviderController')->addView();
                break;
            case 'edit_provider':
                return app('App\Http\Controllers\Admin\V1\ProviderController')->editView($id);
                break;
            case 'new_category':
                return app('App\Http\Controllers\Admin\V1\CategoryController')->addView();
                break;
            case 'edit_category':
                return app('App\Http\Controllers\Admin\V1\CategoryController')->editView($id);
                break;
            case 'new_service':
                return app('App\Http\Controllers\Admin\V1\ServiceController')->addView();
                break;
            case 'providers_list':
                $provider = $request->provider;
                return app('App\Http\Controllers\Admin\V1\ServiceController')->providersList($provider);
                break;
            case 'service-sortable':
                $data = $request->all();
                return app('App\Http\Controllers\Admin\V1\ServiceController')->serviceSortable($data);
                break;
            case 'category-sortable':
                $data = $request->all();
                return app('App\Http\Controllers\Admin\V1\CategoryController')->categorySortable($data);
                break;
            case 'edit_description':
                return app('App\Http\Controllers\Admin\V1\ServiceController')->editDescription($id);
                break;
            case 'edit_service':
                return app('App\Http\Controllers\Admin\V1\ServiceController')->editView($id);
                break;
            case 'import_services':
                return app('App\Http\Controllers\Admin\V1\ServiceController')->importServicesView();
                break;
            case 'import_services_last':
                $data = $request->all();
                return app('App\Http\Controllers\Admin\V1\ServiceController')->importServicesLast($data);
                break;
            case 'import_services_list':
                $provider = $request->provider;
                $category = $request->category;
                return app('App\Http\Controllers\Admin\V1\ServiceController')->importServicesList($provider, $category);
                break;
            case 'price_user':
                return app('App\Http\Controllers\Admin\V1\ClientController')->priceUser($id);
                break;
            case 'edit_user':
                return app('App\Http\Controllers\Admin\V1\ClientController')->editUser($id);
                break;
            case 'pass_user':
                return app('App\Http\Controllers\Admin\V1\ClientController')->passUser($id);
                break;
            case 'new_user':
                return app('App\Http\Controllers\Admin\V1\ClientController')->addView();
                break;
            case 'edit_admin':
                return app('App\Http\Controllers\Admin\V1\AdminController')->editUser($id);
                break;
            case 'pass_admin':
                return app('App\Http\Controllers\Admin\V1\AdminController')->passUser($id);
                break;
            case 'new_admin':
                return app('App\Http\Controllers\Admin\V1\AdminController')->addView();
                break;
            case 'order_errors':
                return app('App\Http\Controllers\Admin\V1\OrderController')->orderErrors($id);
                break;
            case 'details':
                return app('App\Http\Controllers\Admin\V1\OrderController')->orderDetailsApi($id);
                break;
            case 'order_orderurl':
                return app('App\Http\Controllers\Admin\V1\OrderController')->orderUrl($id, 'url');
                break;
            case 'order_startcount':
                return app('App\Http\Controllers\Admin\V1\OrderController')->orderUrl($id, 'start');
                break;
            case 'order_partial':
                return app('App\Http\Controllers\Admin\V1\OrderController')->orderUrl($id, 'remains');
                break;
            case 'order_comment':
                return app('App\Http\Controllers\Admin\V1\OrderController')->orderUrl($id, 'comments');
                break;
            case 'new_bankaccount':
                return app('App\Http\Controllers\Admin\V1\BankAccountController')->addView();
                break;
            case 'edit_bankaccount':
                return app('App\Http\Controllers\Admin\V1\BankAccountController')->editView($id);
                break;
            case 'new_ticket':
                return app('App\Http\Controllers\Admin\V1\TicketController')->addView();
                break;
            case 'edit_ticket':
                return app('App\Http\Controllers\Admin\V1\TicketController')->editView($id);
                break;
            case 'payment_new':
                return app('App\Http\Controllers\Admin\V1\PaymentController')->addView();
                break;
            case 'payment_banknew':
                return app('App\Http\Controllers\Admin\V1\PaymentBankController')->addView();
                break;
            case 'edit_paymentmethod':
                return app('App\Http\Controllers\Admin\V1\PaymentMethodController')->editPaymentmethod($id);
                break;
            case 'payment_edit':
                return app('App\Http\Controllers\Admin\V1\PaymentController')->editView($id, 'method');
                break;
            case 'payment_bankedit':
                return app('App\Http\Controllers\Admin\V1\PaymentController')->editView($id, 'bank');
                break;
            case 'new_language':
                return app('App\Http\Controllers\Admin\V1\LanguageController')->addView();
                break;
            case 'edit_language':
                return app('App\Http\Controllers\Admin\V1\LanguageController')->editView($id);
                break;
            case 'log_desc':
                return app('App\Http\Controllers\Admin\V1\LogController')->editView($id);
                break;
            default:
                # code...
                break;
        }
    }
}
