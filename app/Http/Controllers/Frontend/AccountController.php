<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\User;
use Route;
use Illuminate\Http\Request;
use Input;
use Mail;
use Session;
use Carbon\Carbon;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use App\Libraries\Helpers;
use App\Repositories\Provider\ProviderRepositoryInterface;
use App\Repositories\BankAccount\BankAccountRepositoryInterface;
use App\Repositories\User\UserRepositoryInterface;
use App\Repositories\Service\ServiceRepositoryInterface;
use Illuminate\Support\Facades\Log;
use App\Repositories\Payment\PaymentRepositoryInterface;
use App\Repositories\CashFlow\CashFlowRepositoryInterface;
use App\Repositories\PaymentMethod\PaymentMethodRepositoryInterface;
use App\Repositories\ServiceReview\ServiceReviewRepositoryInterface;
use Illuminate\Support\Facades\Artisan;
use Storage;
use Illuminate\Support\Str;


class AccountController extends Controller
{
    protected $bankAccountRepository;
    protected $paymentRepository;
    protected $userRepository;
    protected $cashFlowRepository;
    protected $providerRepository;
    protected $paymentMethodRepository;
    protected $serviceReviewRepository;
    protected $serviceRepository;

    public function __construct(
        ServiceRepositoryInterface $serviceRepository,
        ServiceReviewRepositoryInterface $serviceReviewRepository,
        PaymentMethodRepositoryInterface $paymentMethodRepository,
        CashFlowRepositoryInterface $cashFlowRepository,
        PaymentRepositoryInterface $paymentRepository,
        UserRepositoryInterface $userRepository,
        ProviderRepositoryInterface $providerRepository,
        BankAccountRepositoryInterface $bankAccountRepository
    ) {
        $this->serviceReviewRepository = $serviceReviewRepository;
        $this->paymentMethodRepository = $paymentMethodRepository;
        $this->providerRepository = $providerRepository;
        $this->bankAccountRepository = $bankAccountRepository;
        $this->cashFlowRepository = $cashFlowRepository;
        $this->userRepository = $userRepository;
        $this->paymentRepository = $paymentRepository;
        $this->serviceRepository = $serviceRepository;
    }
    public function index()
    {
        return view('front-end.account.index');
    }

    public function history(Request $request){
        $from = $request->from;
        $to = $request->to;
        $items = $this->paymentRepository->historyPayment(Auth::user()->id, $from, $to);
        $viewRender = view('frontend.history-addfunds', compact('items'))->render();
        return response()->json([
            'message' => $viewRender,
            'success' => 1
        ]);
    }

    public function uploadAvatar(Request $request)
    {
        $validation_rules = [
            'file' => 'mimes:jpg,jpeg,png|max:2048',
        ];
        $messages = [
            'required' => 'The :attribute field is required.',
            'mimes' => 'Only jpeg, png are allowed.',
            'max' => 'Please upload file under 2MB'
        ];
        $validator = Validator::make($request->all(), $validation_rules, $messages);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        $user = Auth::user();
        try{
            $avatar = $this->putFileImage($request->file('file'));
            if($avatar){
                $user->update(['avatar' => '/avatar/'.$avatar]);
            }else{
                $user->update(['avatar' => '/assets/images/blank-profile-picture-973460_1280.webp']);
            }
            return redirect()->route('account.index')->with('notify', 'Upload avatar successfully');

        }catch(\Exception $e){
            Log::error('uploadAvatar:'.$e->getMessage());
            $user->update(['avatar' => '/assets/images/blank-profile-picture-973460_1280.webp']);
            return redirect()->route('account.index')->with('notify', 'Upload avatar successfully');
        }
    }

    private function putFileImage($image)
    {
        if (!Storage::disk('public_home')->exists('/avatar')) {
            Storage::disk('public_home')->makeDirectory('avatar/');
        }
        $fileName = $image->getClientOriginalName();
        @$temp = explode(".", $fileName);
        @$temp = Str::slug(@$temp['0']) . '.' . @$temp['1'];
        Storage::disk('public_avatar')->putFileAs('', $image, $fileName);
        return $fileName;
    }

    public function accountPost(Request $request)
    {
        $user = Auth::user();
        $id = $user->id;
        $url =  route('account.index');
        $msg = "Changes saved successfully";
        if(array_key_exists("new_password", $request->all())){
            if(!$request->current_password) {
                $msg = 'Password must be at least 8 characters';
                return Redirect::back()->withErrors($msg);
            }
            $current_pass = $user->password;
            if (Hash::check($request->current_password, $user->password)) {
                if ($request->new_password == $request->confirm_password) {
                    $data = array(
                        'password' => bcrypt($request->new_password)
                    );
                } else {
                    $msg = 'Confirmation password does not match';
                    return Redirect::back()->withErrors($msg);
                }
            } else {
                $msg = 'Wrong password';
                return Redirect::back()->withErrors($msg);
            }
            $respons = User::find($id)->update($data);
            return redirect()->route('account.index')->with('status', $msg);
        }
        if(array_key_exists("time_zone", $request->all())){
            User::find($id)->update(array(
                'time_zone' => $request->time_zone
            ));
            return redirect()->route('account.index')->with('status', $msg);
        }
        return redirect()->route('account.index')->with('status', $msg);
    }

    public function newkey(Request $request) {
        
        $keyApi = Str::random(40);
            User::find(Auth::user()->id)->update(array(
                'key_api' => $keyApi
            ));
            $msg = "API key has been generated: <br>
            ".$keyApi."";
            return redirect()->route('account.index')->with('status', $msg);
    }

    public function submitRating(Request $request)
    {
        try {
            $rating_data = $request->rating_data;
            $user_review = $request->user_review;
            $service_id = $request->service_id;
            $user = Auth::user();
            $count = $this->serviceReviewRepository->reviewUser($user->id, $service_id);
            if ($count > 0) {
                return response()->json([
                    'error' => 1,
                    'message' => 'Please rate later',
                ]);
            }
            $params = [
                'user_id' => $user->id,
                'service_id' => $service_id,
                'user_rating' => $rating_data,
                'user_review' => $user_review,
            ];
            $this->serviceReviewRepository->create($params);
            Artisan::call('systems:update-review');
            return response()->json([
                'success' => 1,
                'message' => 'Thank for your vote',
            ]);
        } catch (\Exception $e) {
            Log::error('submitRating: ' . $e->getMessage());
            return response()->json([
                'error' => 1,
                'message' => 'Not review service',
            ]);
        }
    }

    public function submitLoadData(Request $request)
    {
        try {
            $service_id = $request->service_id;
            $info = $this->serviceRepository->find($service_id);
            Artisan::call('systems:update-review');
            return response()->json([
                'success' => 1,
                'message' => $info->quality
            ]);
        } catch (\Exception $e) {
            Log::error('submitRating: ' . $e->getMessage());
            return response()->json([
                'error' => 1,
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function serviveReview($id)
    {
        $info = $this->serviceRepository->find($id);
        $items = $this->serviceReviewRepository->findService($id);
        return view('frontend.review-service', compact('info', 'items'));
    }
}
