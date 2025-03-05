<?php

namespace App\Http\Controllers\Admin\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Setting, App\Model\Admin, App\Model\Addtocard;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str, Log;
use App\User;
use Auth, DB, File, Image, Redirect, Cache, URL;
use App\Exports\CustomerExport;
use App\Exports\OrderExport;
use Maatwebsite\Excel\Facades\Excel;
use WebService;
use Carbon\Carbon, Storage;
use Validator;
use App\Libraries\Helpers;
use Response;
use App\Model\Provider;
use App\Repositories\Provider\ProviderRepositoryInterface;
use App\Repositories\Category\CategoryRepositoryInterface;
use App\Repositories\Service\ServiceRepositoryInterface;
use App\Repositories\UserPrice\UserPriceRepositoryInterface;

use LDAP\Result;

class ServiceController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    protected $providerRepository;
    protected $categoryRepository;
    protected $userPriceRepository;
    protected $serviceRepository;
    public function __construct(
        UserPriceRepositoryInterface $userPriceRepository,
        ProviderRepositoryInterface $providerRepository,
        ServiceRepositoryInterface $serviceRepository,
        CategoryRepositoryInterface $categoryRepository
    ) {
        $this->userPriceRepository = $userPriceRepository;
        $this->providerRepository = $providerRepository;
        $this->categoryRepository = $categoryRepository;
        $this->serviceRepository = $serviceRepository;
    }

    public function images(Request $request)
    {
        @$url = URL::to('/');
        @$errorImgFile = $url . "/uploads/upload-error.png";
        if (@$request->hasFile('file')) {
            @$temp = explode(".", @$_FILES["file"]["name"]);
            @$temp = Str::slug(@$temp['0']) . '.' . @$temp['1'];
            @$destinationFilePath = './images/' . $temp;
            @$rawlocation = $url . '/images/' . $temp;
            if (!move_uploaded_file(@$_FILES['file']['tmp_name'], @$destinationFilePath)) {
                echo @$errorImgFile;
            } else {
                echo @$rawlocation;
            }
        }
    }

    public function serviceSortable($data)
    {
        $services = $data['services'];
        foreach ($services as $item) {
            $id = str_replace('service-', '', $item['id']);
            $info = $this->serviceRepository->find($id);
            $info->update(['service_line' => $item['line']]);
        }
    }

    public function multiAction(Request $request)
    {
        $action = $request->bulkStatus;
        $service = $request->service;
        if ($service) {
            $services = [];
            foreach ($service as $key => $value) {
                $services[] = $key;
            }
            if ($action ==  "active") {
                $service_type = 2;
                $this->serviceRepository->typeServices($services, $service_type);
            } else if ($action ==  "deactive") {
                $service_type = 1;
                $this->serviceRepository->typeServices($services, $service_type);
            } else if ($action ==  "secret") {
                $service_secret = 1;
                $this->serviceRepository->secretServices($services, $service_secret);
            } else if ($action ==  "desecret") {
                $service_secret = 2;
                $this->serviceRepository->secretServices($services, $service_secret);
            } else if ($action ==  "del_price") {
                $this->userPriceRepository->deleteServices($services);
            } else if ($action ==  "del_service") {
                $this->serviceRepository->deleteServices($services);
            }
            return redirect()->route('admin.services');
        }
    }

    public function serviceDeactive($id)
    {
        $info = $this->serviceRepository->find($id);
        $info->update(['service_type' => 1]);
        return redirect()->route('admin.services');
    }

    public function serviceActive($id)
    {
        $info = $this->serviceRepository->find($id);
        $info->update(['service_type' => 2]);
        return redirect()->route('admin.services');
    }

    public function editDesc($id)
    {
        $info = $this->serviceRepository->find($id);
        return view('admin-view.services.edit-desc', compact('info'));
    }

    public function edit($id)
    {
        $info = $this->serviceRepository->find($id);
        $categories = $this->categoryRepository->getCategory();
        $providers = $this->providerRepository->getProvider();
        $info = $this->serviceRepository->find($id);
        $providerInfo = $this->providerRepository->find($info->service_api);
        $services = "";
        if ($providerInfo) {
            $services = Helpers::action(["key" => $providerInfo->api_key, "action" => "services"], $providerInfo->api_url, $providerInfo->type_api);
        }
        if (@$services->error) {
            return response()->json([
                'content' => 'Error api' . @$services->error,
                'title' => 'Error api(' . @$services->error . ')',
            ]);
        }
        return view('admin-view.services.edit-view', compact('info', 'categories', 'providers', 'services'));
    }

    public function editDescription($id)
    {
        $info = $this->serviceRepository->find($id);
        $viewRender = view('admin-view.services.edit-description', compact('info'))->render();
        return response()->json([
            'content' => $viewRender,
            'title' => 'Edit Speed per day (ID:' . $id . ')',
        ]);
    }

    public function updateDescription(Request $request, $id)
    {
        $info = $this->serviceRepository->find($id);
        // $validation_rules = array(
        //     'service_description' => 'required',
        // );
        // $messages = array(
        //     'service_description.required' => 'Description cannot be empty',

        // );
        // $validator = Validator::make($request->all(), $validation_rules, $messages);
        // if ($validator->fails()) {
        //     return response()->json([
        //         'm' => $validator->messages(),
        //         's' => 'error',
        //         'r' => null,
        //         't' => "error",
        //         'time' => 1
        //     ]);
        // }
        $info->update($request->all());
        return response()->json([
            'r' => route('admin.services'),
            'm' => 'Update thành công',
            's' => 'success',
            't' => "error",
            'time' => 1
        ]);
    }

    public function importServicesLast($data)
    {
        $services = $data['services'];
        $provider = $data['provider'];
        $grouped = Helpers::array_group_by($services, "category");
        $providerInfo = $this->providerRepository->find($provider);
        $apiServices = Helpers::action(["key" => $providerInfo->api_key, "action" => "services"], $providerInfo->api_url, $providerInfo->type_api);
        $viewRender = view('admin-view.services.import-services-last', compact('apiServices', 'grouped'))->render();
        return $viewRender;
    }

    public function delPrice($id)
    {
        $this->userPriceRepository->deleteService($id);
        return redirect()->route('admin.services');
    }

    public function importServicesList($provider, $category)
    {
        $providerInfo = $this->providerRepository->find($provider);
        $services = Helpers::action(["key" => $providerInfo->api_key, "action" => "services"], $providerInfo->api_url, $providerInfo->type_api);
        $grouped = Helpers::array_group_by($services, "category");
        $viewRender = view('admin-view.services.import-services-list', compact('provider', 'category', 'services', 'grouped'))->render();
        return $viewRender;
    }

    public function importServicesView()
    {
        $categories = $this->categoryRepository->getCategory();
        $providers = $this->providerRepository->getProvider();

        $viewRender = view('admin-view.services.import-services', compact('categories', 'providers'))->render();
        return response()->json([
            'content' => $viewRender,
            'title' => 'Pull services from provider',
        ]);
    }

    public function getServicesAdd(Request $request)
    {
        $services = $request->servicesList;
        $provider_id  = $request->provider;
        $category  = $request->category;
        $providerInfo = $this->providerRepository->find($provider_id);
        $apiServices = Helpers::action(["key" => $providerInfo->api_key, "action" => "services"], $providerInfo->api_url, $providerInfo->type_api);
        $balance = Helpers::action(["key" => $providerInfo->api_key, "action" => "balance"], $providerInfo->api_url, $providerInfo->type_api);
        if (count($services)) :
            foreach ($services as $service => $price) :
                foreach ($apiServices as $apiService) :
                    if ($service == $apiService->service && $service != 0) :
                        $package = Helpers::serviceTypeGetList2($apiService->type);
                        $detail = [];
                        $detail["min"] = $apiService->min;
                        $detail["max"] = $apiService->max;
                        $detail["rate"] = $apiService->rate;
                        $detail["currency"] = $balance->currency;
                        $service_name = $package == 11 ? mb_convert_encoding($apiService->name, "UTF-8", "auto") : $apiService->name;
                        $name_lang = '{"en":"' . $service_name . '"}';
                        $price = ceil($price * 100) / 100;
                        $params = [
                            'service_api' => $provider_id,
                            'api_service' =>   $service,
                            'service_package' => $package,
                            'service_line' => 1,
                            'service_type' => 2,
                            'service_name' => $service_name,
                            'api_detail' => json_encode($detail),
                            'category_id' => $category,
                            'service_min' => $apiService->min,
                            'service_max' => $apiService->max,
                            'service_price' => $price,
                            'name_lang' => $name_lang,
                        ];
                        $this->serviceRepository->create($params);
                    endif;
                endforeach;
            endforeach;
        endif;
        return response()->json([
            'r' => route('admin.services'),
            'm' => 'Transaction successful',
            's' => 'success',
            't' => "error",
            'time' => 1
        ]);
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function services()
    {
        $items = $this->categoryRepository->getCategory();
        return view('admin-view.services.list', compact('items'));
    }

    public function addView()
    {
        $categories = $this->categoryRepository->getCategory();
        $providers = $this->providerRepository->getProvider();
        $viewRender = view('admin-view.services.add', compact('categories', 'providers'))->render();
        return response()->json([
            'content' => $viewRender,
            'title' => 'Add new provider',
        ]);
    }

    public function add()
    {
        $categories = $this->categoryRepository->getCategory();
        $providers = $this->providerRepository->getProvider();
        return view('admin-view.services.add-view', compact('categories', 'providers'));
    }

    public function providersList($provider)
    {
        $providerInfo = $this->providerRepository->find($provider);
        if ($providerInfo->api_type == 3) {
            echo "<div class=\"service-mode__block\"><div class=\"form-group\">  <label>Service</label> <input class=\"form-control\" name=\"service\" placeholder=\"Enter Service ID\">\r\n\r\n          </div>\r\n\r\n        </div>";
            die;
        } else if ($providerInfo->api_type == 1) {
            $services = Helpers::action(["key" => $providerInfo->api_key, "action" => "services"], $providerInfo->api_url, $providerInfo->type_api);
            $html = '<div class="service-mode__block">
            <div class="form-group">
            <label>Service</label>
              <select class="form-control select2" name="service">';
            if (!empty($services)) {
                foreach ($services as $item) {
                    $html .= '<option value="' . $item->service . '">' . $item->service . " - " . $item->name . " - " . Helpers::priceFormat($item->rate) . '</option>';
                }
            }
            $html .= '</select></div></div>';
            echo $html;
        }
    }

    public function store(Request $request)
    {
        $validation_rules = array(
            'name' => 'required|max:255',
            'category' => 'required|max:255',
            'price' => 'required|numeric',
            'min' => 'required|numeric',
            'max' => 'required|numeric',
        );
        $messages = array(
            'name.required' => 'Service name cannot be empty',
            'category.required' => 'Service Category cannot be empty',
            'provider.required' => 'Service provider cannot be empty',
            'price.required' => 'The product price should consist of numbers',
            'min.required' => 'Minimum order quantity cannot be empty',
            'max.required' => 'Maximum order quantity cannot be empty',
            'min.numeric' => 'Minimum order quantity cannot be empty',
            'price.numeric' => 'The product price should consist of numbers',
            'max.numeric' => 'Maximum order quantity cannot be empty',
        );
        if ($request->mode == 2) {
            $validation_rules['provider'] = 'required';
        }
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
        $category_id = $request->category;
        $service_line = $this->serviceRepository->getLastLine($category_id);
        $service_name = $request->name;
        $service_package = $request->package;
        $mode = $request->mode;
        $api_service = $request->service;
        $service_api = $request->provider ? $request->provider : 0;
        $api_detail = "";
        if ($service_api > 0) {
            $providerInfo = $this->providerRepository->find($service_api);
            $services = Helpers::action(["key" => $providerInfo->api_key, "action" => "services"], $providerInfo->api_url, $providerInfo->type_api);
            $balance = Helpers::action(["key" => $providerInfo->api_key, "action" => "balance"], $providerInfo->api_url, $providerInfo->type_api);
            foreach ($services as $apiService) :
                if ($api_service == $apiService->service) :
                    $detail["min"] = $apiService->min;
                    $detail["max"] = $apiService->max;
                    $detail["rate"] = $apiService->rate;
                    $detail["currency"] = $balance->currency;
                    $api_detail = json_encode($detail);
                endif;
            endforeach;
        }
        $service_dripfeed = $request->dripfeed;
        $service_price = $request->price;
        $service_min = $request->min;
        $service_max = $request->max;
        $cancel_type = $request->cancel_type;
        $refill_type = $request->refill_type;
        $refill_time = $request->refill_time ? $request->refill_time : 0;
        $want_username = $request->want_username;
        $service_secret = $request->secret;
        $service_speed = $request->speed;
        if ($mode == 1) : $service_api = 0;
            $api_service = 0;
        endif;
        $params = [
            'mode' => $mode,
            'api_detail' => $api_detail,
            'service_dripfeed' => $service_dripfeed,
            'cancel_type' => $cancel_type,
            'refill_type' => $refill_type,
            'service_name' => $service_name,
            'service_api' => $service_api,
            'want_username' => $want_username,
            'service_secret' => $service_secret,
            'service_type' => 2,
            'service_speed' => $service_speed,
            'refill_time' => $refill_time,
            'api_service'   => $api_service,
            'api_servicetype'    => 2,
            'category_id'   => $category_id,
            'service_line' => $service_line,
            'service_package' => $service_package,
            'service_min' => $service_min,
            'service_max' => $service_max,
            'service_description' => null,
            'service_price' => $service_price,
        ];
        $this->serviceRepository->create($params);
        return response()->json([
            'r' => route('admin.services'),
            'm' => 'Transaction successful',
            's' => 'success',
            't' => "error",
            'time' => 1
        ]);
    }

    public function editView($id)
    {
        try {
            $categories = $this->categoryRepository->getCategory();
            $providers = $this->providerRepository->getProvider();
            $info = $this->serviceRepository->find($id);
            $providerInfo = $this->providerRepository->find($info->service_api);
            $services = "";
            if ($providerInfo) {
                $services = Helpers::action(["key" => $providerInfo->api_key, "action" => "services"], $providerInfo->api_url, $providerInfo->type_api);
            }
            if (@$services->error) {
                return response()->json([
                    'content' => 'Error api' . @$services->error,
                    'title' => 'Error api(' . @$services->error . ')',
                ]);
            }
            $viewRender = view('admin-view.services.edit', compact('info', 'categories', 'providers', 'services'))->render();
            return response()->json([
                'content' => $viewRender,
                'title' => 'Edit service(' . $info->service_name . ')',
            ]);
        } catch (\Exception $e) {
            echo $e->getMessage();
            Log::error($e->getMessage());
        }
    }

    public function update($id, Request $request)
    {
        $info = $this->serviceRepository->find($id);
        $validation_rules = array(
            'name' => 'required|max:255',
            'category' => 'required|max:255',
            'price' => 'required|numeric',
            'min' => 'required|numeric',
            'max' => 'required|numeric',
        );
        $messages = array(
            'name.required' => 'Service name cannot be empty',
            'category.required' => 'Service Category cannot be empty',
            'provider.required' => 'Service provider cannot be empty',
            'price.required' => 'The product price should consist of numbers',
            'min.required' => 'Minimum order quantity cannot be empty',
            'max.required' => 'Maximum order quantity cannot be empty',
            'min.numeric' => 'Minimum order quantity cannot be empty',
            'price.numeric' => 'The product price should consist of numbers',
            'max.numeric' => 'Maximum order quantity cannot be empty',

        );
        if ($request->mode == 2) {
            $validation_rules['provider'] = 'required';
        }
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

        $category_id = $request->category;
        $last_line = $this->serviceRepository->getLastLine($category_id);
        $line = $last_line + 1;
        $service_name = $request->name;
        $service_package = $request->package;
        $mode = $request->mode;
        $service_api = $request->provider ? $request->provider : 0;
        $api_detail = "";
        $api_service = $request->service;
        $price_api = 0;
        if ((int)$service_api > 0) {
            $providerInfo = $this->providerRepository->find($service_api);
            $services = Helpers::action(["key" => $providerInfo->api_key, "action" => "services"], $providerInfo->api_url, $providerInfo->type_api);
            $balance = Helpers::action(["key" => $providerInfo->api_key, "action" => "balance"], $providerInfo->api_url, $providerInfo->type_api);
            foreach ($services as $apiService) :
                if ($api_service == $apiService->service) :
                    $detail["min"] = $apiService->min;
                    $detail["max"] = $apiService->max;
                    $detail["rate"] = $apiService->rate;
                    $detail["currency"] = $balance->currency;
                    $price_api = $apiService->rate;

                    $api_detail = json_encode($detail);
                endif;
            endforeach;
        }

        $service_dripfeed = $request->dripfeed;
        $price = $request->price;
        $service_min = $request->min;
        $service_max = $request->max;
        $cancel_type = $request->cancel_type;
        $refill_type = $request->refill_type;

        $refill_time = $request->refill_time ? $request->refill_time : 0;

        $want_username = $request->want_username;
        $service_secret = $request->secret;
        $service_speed = $request->speed;
        $api_servicetype = 2;
        $auto_min = $request->auto_min;
        $auto_max = $request->auto_max;
        $auto_price = $request->auto_price;
        $sync_rate = $request->sync_rate;
        if (isset($auto_min)) {
            $auto_min = 1;
        } else {
            $auto_min = 0;
        }

        if (isset($auto_max)) {
            $auto_max = 1;
        } else {
            $auto_max = 0;
        }

        if (isset($auto_price)) {
            $auto_price = 1;
            $yuzde = Helpers::rateSync($sync_rate, $price_api);
            $topla = $yuzde + $price_api;
            $service_price = round($topla, 2);
        } else {
            $auto_price = 0;
            $service_price = $price;
        }
        $api_service = $api_service > 0 ? $api_service : 0;
        $params = [
            'api_detail' => $api_detail,
            'service_dripfeed' => $service_dripfeed,
            'cancel_type' => $cancel_type,
            'refill_type' => $refill_type,
            'service_name' => $service_name,
            'service_api' => $service_api,
            'want_username' => $want_username,
            'service_secret' => $service_secret,
            'service_speed' => $service_speed,
            'refill_time' => $refill_time,
            'api_service'   => $api_service,
            'api_servicetype'    => $api_servicetype,
            'category_id'   => $category_id,
            'service_package' => $service_package,
            'sync_price' => $auto_price,
            'auto_price' => $auto_price,
            'auto_max' => $auto_max,
            'auto_max' => $auto_max,
            'service_min' => $service_min,
            'service_max' => $service_max,
            'service_price' => $service_price,
            'mode' => $request->mode
        ];
        if($mode==1){
            $params['api_detail'] = '';
            $params['api_service'] = 0;
            $params['service_api'] = 0;
        }
        $info->update($params);
        // update line
        $updateLines = $this->serviceRepository->updateLineService($category_id, $last_line);
        if (count($updateLines) > 0) {
            foreach ($updateLines as $itemLine) {
                $itemLine->update(['service_line' => ($itemLine->service_line - 1)]);
            }
        }
        return response()->json([
            'r' => $request->current,
            'm' => 'Update thành công',
            's' => 'success',
            't' => "error",
            'time' => 1
        ]);
    }

    public function destroy($id)
    {
        $this->serviceRepository->delete($id);
        return redirect()->route('admin.services');
    }
}
