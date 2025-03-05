<?php

namespace App\Http\Controllers\Admin\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Setting, App\Model\Admin, App\Model\Addtocard;
use Illuminate\Support\Facades\Validator;
use App\Libraries\Helpers;
use Illuminate\Support\Str;
use App\User;
use Auth, DB, File, Image, Redirect, Cache;
use App\Exports\CustomerExport;
use App\Exports\OrderExport;
use Maatwebsite\Excel\Facades\Excel;
use WebService;
use Carbon\Carbon;
use Response;
use App\Model\Provider;
use App\Repositories\Provider\ProviderRepositoryInterface;

class ProviderController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    private $providerRepository;
    public function __construct(ProviderRepositoryInterface $providerRepository){
        $this->providerRepository = $providerRepository;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function providers(){
       return view('admin-view.providers.list');
    }

    public function apiBalance(Request $request){
        $check = $request->q;
        $items = $this->providerRepository->getProvider();
       return view('admin-view.providers.api-balance', compact('items', 'check'));
    }

    public function addView(){
        $viewRender = view('admin-view.providers.add')->render();
        return response()->json([
            'content' => $viewRender,
            'title' => 'Add new provider',
        ]);
    }

    public function store(Request $request){
        $validation_rules = array(
            'url' => 'required|max:255',
            'key' => 'required|max:255',
        );
        $messages = array(
            'url.required' => 'Provider API URL cannot be empty',
            'key.required' => 'Provider API URL cannot be empty',
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
        $url = $request->url;
        $key = $request->key;
        $api = Helpers::action(["key" => $key, "action" => "balance"], $url, 'urlencoded');
        $type_api = 'urlencoded';
        if($api==false){
            $api = Helpers::action(["key" => $key, "action" => "balance"], $url, 'json');
            $type_api = 'json';
        }
        preg_match('/\/\/([^\/]+)?/', $url, $output_array);
        if(count($output_array)>0){
            $name = $output_array[1];
        }else{
            $name = $url;
        }
        $balance = 0;
        $params =[
            'api_name' => $name,
            'type_api' => $type_api,
            'api_url'   => $url,
            'api_key'    => $key,
            'balance'   => $balance,
            'api_type' => 1,
            'api_limit' => 0,
            'api_alert' => 2,
            'status' =>1
        ];
        $this->providerRepository->create($params);
        return response()->json([
                'r' => route('admin.providers'),
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
        $token = $this->updateToken($info->api_url, $info->user, $info->password);
        if($token) {
            $info->update(['token' => $token]);
        }
        return response()->json([
                'r' => route('admin.providers'),
                'm' => 'Update thành công',
                's' => 'success',
                't' => "error",
                'time' => 1
            ]);
    }

    public function updateToken($api_url, $user, $password) {
        $curl = curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL => $api_url.'/login',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS =>'{
            "username": "'.$user.'",
            "password": "'.$password.'"
        }',
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json'
        ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $arr = json_decode($response);
        if($arr && $arr->success){
            return $arr->data->token;
        }
        return null;
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
