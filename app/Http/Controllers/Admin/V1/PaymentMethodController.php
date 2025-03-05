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
use App\Repositories\PaymentMethod\PaymentMethodRepositoryInterface;

class PaymentMethodController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    private $paymentMethodRepository;
    public function __construct(PaymentMethodRepositoryInterface $paymentMethodRepository)
    {
        $this->paymentMethodRepository = $paymentMethodRepository;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function paymentMethods()
    {
        $items = $this->paymentMethodRepository->getPaymentMethod();
        return view('admin-view.payment-methods.list', compact('items'));
    }

    public function paymentMethodEdit($id) {
        $info = $this->paymentMethodRepository->find($id);
        return view('admin-view.payment-methods.edit-content', compact('info'));
    }

    public function updateContent($id, Request $request) {
        $info = $this->paymentMethodRepository->find($id);
        $info->method_content = $request->method_content;
        $info->save();
        return redirect()->route('admin.payment-methods');
    }

    public function editPaymentmethod($id)
    {
        $info = $this->paymentMethodRepository->findMethodGet($id);
        $method_extras = $info->method_extras;
        $methodExtrasArr =  json_decode($method_extras);
        $name = !empty($methodExtrasArr) ? $methodExtrasArr->name : '';
        $viewRender = view('admin-view.payment-methods.edit', compact('info'))->render();
        return response()->json([
            'content' => $viewRender,
            'title' => 'Edit payment method (Method: '.$name.')',
        ]);
    }

    public function type(Request $request)
    {
        $id = $request->id;
        $info = $this->paymentMethodRepository->find($id);
        $method_type = $info->method_type;
        if ($method_type == 2) {
            $data = ['method_type' => 1];
        } else {
            $data = ['method_type' => 2];
        }
        $info->update($data);
        return 1;
    }

    public function addView()
    {
        $viewRender = view('admin-view.providers.add')->render();
        return response()->json([
            'content' => $viewRender,
            'title' => 'Add new provider',
        ]);
    }

    public function store(Request $request)
    {
        $validation_rules = array(
            'url' => 'required|max:255',
            'key' => 'required|max:255',
        );
        $messages = array(
            'url.required' => 'Provider API URL cannot be empty',
            'key.required' => 'Provider API URL cannot be empty',
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
        $url = $request->url;
        $key = $request->key;
        $api = Helpers::action(["key" => $key, "action" => "balance"], $url, 'urlencoded');
        $type_api = 'urlencoded';
        if ($api == false) {
            $api = Helpers::action(["key" => $key, "action" => "balance"], $url, 'json');
            $type_api = 'json';
        }
        preg_match('/\/\/([^\/]+)?/', $url, $output_array);
        if (count($output_array) > 0) {
            $name = $output_array[1];
        } else {
            $name = $url;
        }
        $balance = 0;
        $params = [
            'api_name' => $name,
            'type_api' => $type_api,
            'api_url'   => $url,
            'api_key'    => $key,
            'balance'   => $balance,
            'api_type' => 1,
            'api_limit' => 0,
            'api_alert' => 2,
            'status' => 1
        ];
        $this->paymentMethodRepository->create($params);
        return response()->json([
            'r' => route('admin.payment-methods'),
            'm' => 'Transaction successful',
            's' => 'success',
            't' => "error",
            'time' => 1
        ]);
    }

    public function editView($id)
    {
        $info = $this->paymentMethodRepository->find($id);
        $api = Helpers::action(["key" => $info->api_key, "action" => "balance"], $info->api_url, 'urlencoded');
        $type_api = 'urlencoded';
        if ($api == false) {
            $api = Helpers::action(["key" => $info->api_key, "action" => "balance"], $info->api_url, 'json');
            $type_api = 'json';
        }
        $viewRender = view('admin-view.providers.edit', compact('info', 'type_api'))->render();
        return response()->json([
            'content' => $viewRender,
            'title' => 'Edit provider(' . $info->name . ')',
        ]);
    }

    public function update($id, Request $request)
    {
        $info = $this->paymentMethodRepository->findMethodGet($id);
        $params = [
            'method_min' => $request->min ? $request->min : 0,
            'method_max' => $request->max ? $request->max : 0,
            'method_type' => $request->method_type,
            'method_extras' => json_encode($request->all())

        ];
        $info->update($params);
        return response()->json([
            'r' => route('admin.payment-methods'),
            'm' => 'Update thành công',
            's' => 'success',
            't' => "error",
            'time' => 1
        ]);
    }

    public function destroy($id)
    {
        $this->paymentMethodRepository->delete($id);
        return response()->json([
            'r' => route('admin.payment-methods'),
            'm' => 'Xóa thành công',
            's' => 'success',
            't' => "error",
            'time' => 1
        ]);
    }
}
