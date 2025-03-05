<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\User;
use Auth;
use Redirect;
use Route;
use Illuminate\Http\Request;
use DB;
use Hash;
use Validator;
use Mail;
use Session, URL;
use Carbon\Carbon;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

use App\Repositories\Provider\ProviderRepositoryInterface;
use App\Repositories\BankAccount\BankAccountRepositoryInterface;
use App\Repositories\User\UserRepositoryInterface;
use App\Repositories\Payment\PaymentRepositoryInterface;
use App\Repositories\CashFlow\CashFlowRepositoryInterface;
use App\Repositories\PaymentMethod\PaymentMethodRepositoryInterface;


class PaymentMethodController extends Controller
{
    protected $bankAccountRepository;
    protected $paymentRepository;
    protected $userRepository;
    protected $cashFlowRepository;
    protected $providerRepository;
    protected $paymentMethodRepository;
    public function __construct(
        PaymentMethodRepositoryInterface $paymentMethodRepository,
        CashFlowRepositoryInterface $cashFlowRepository,
        PaymentRepositoryInterface $paymentRepository,
        UserRepositoryInterface $userRepository,
        ProviderRepositoryInterface $providerRepository,
        BankAccountRepositoryInterface $bankAccountRepository
    ) {
        $this->paymentMethodRepository = $paymentMethodRepository;
        $this->providerRepository = $providerRepository;
        $this->bankAccountRepository = $bankAccountRepository;
        $this->userRepository = $userRepository;
        $this->paymentRepository = $paymentRepository;
        $this->cashFlowRepository = $cashFlowRepository;
    }

    public function change(Request $request)
    {
        $method = $request->method;
        $items = null;
        switch ($method) {
            case 'paypal':
                $view = 'frontend.methods.paypal';
                $info = $this->paymentMethodRepository->findMethodGet('paypal');

                $render = view($view, compact('items'))->render();
                break;
            case 'perfectmoney':
                $info = $this->paymentMethodRepository->findMethodGet('perfectmoney');

                $view = 'frontend.methods.perfectmoney';
                $render = view($view, compact('info'))->render();
                break;
            case 'payeer':
                $view = 'frontend.methods.payeer';
                $info = $this->paymentMethodRepository->findMethodGet('payeer');

                $render = view($view, compact('info'))->render();
                break;
            default:
                $items = $this->bankAccountRepository->getAllBankAccount();
                $view = 'frontend.methods.manual';
                $render = view($view, compact('items'))->render();
                break;
        }
        return $render;
    }
}
