<?php
namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;
use App\User;
use Auth;
use Redirect;
use Route;
use Illuminate\Http\Request;
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
use App\Repositories\CashFlow\CashFlowRepositoryInterface;
use App\Repositories\Order\OrderRepositoryInterface;
use App\Http\Resources\ServiceResource;
use App\Http\Resources\OrderResource;
use App\Http\Resources\OrderCollection;


class CashFlowController extends Controller
{
    protected $cashFlowRepository;

    public function __construct(CashFlowRepositoryInterface $cashFlowRepository)
    {
        $this->cashFlowRepository = $cashFlowRepository;
    }

    public function cashflow(Request $request){
        $id = $request->id;
        $userId = Auth::user()->id;
        if(!empty($id)){
            if($this->cashFlowRepository->getCashFlowInfoFirst($userId, $id)){
                $items = $this->cashFlowRepository->getCashFlowInfo($userId, $id);
                return view('frontend.cash-flow-info', compact('items'));
            }else{
               return redirect()->route('cashflow');
            }
        }
        $items = $this->cashFlowRepository->getCashFlow($userId);
        return view('frontend.cashflow', compact('items'));
    }
}