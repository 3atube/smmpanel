<?php
namespace App\Repositories\Payment;

use App\Repositories\BaseRepository;
use DB;

class PaymentRepository extends BaseRepository implements PaymentRepositoryInterface
{
    //lấy model tương ứng
    public function getModel()
    {
        return \App\Model\Payment::class;
    }

    public function getPaymentPagi($search= '', $search_type='', $type='')
    {
        $this->model = $this->model->select('*')->orderBy('id','desc')
        ->when(!empty($search) && $search_type=='username', function ($q) use ($search) {
              return $q->whereHas('user', function($q) use ($search){
                $q->where('name', $search);
            });
        });
        if($type=='bank'){
            $this->model = $this->model->where('payment_method',0);
        }else{
            $this->model = $this->model->where('payment_method','!=',0);
        }
        
        return $this->model->paginate(50);
    }

    public function historyPayment($userId, $from, $to)
    {
        return $this->model->select('*')->where('user_id', $userId)
        ->where(DB::raw('date(created_at)'), '>=', $from)
        ->where(DB::raw('date(created_at)'), '<=', $to)
        ->orderBy('id','desc')->get();
    }

    public function getPaymentByCategory($category)
    {
        return $this->model->select('*')->where('category_id', $category)->orderBy('service_line','asc')->orderBy('id','asc')->get();
    }

    public function getLastLine($category)
    {
        $last = $this->model->select('*')->where('category_id', $category)->orderBy('service_line','desc')->first();
        if(!$last){
            return 1;
        }
        return $last->service_line+1;
    }

    public function findTranId($tranId)
    {
        return $this->model->where('payment_privatecode', $tranId)->first();

    }
    
    public function updateLinePayment($category, $line){
        return $this->model->select('*')->where('category_id', $category)->where('service_line', '>=', $line)->get();
    }

    public function removeByCategory($category){
        return $this->model->select('*')->where('category_id', $category)->delete();
    }

    public function getPaymentUserPrice($user_id){
        // SELECT *,services.service_id as serviceid,services.service_price as price,clients_price.service_price as clientprice FROM services LEFT JOIN clients_price ON clients_price.service_id=services.service_id && clients_price.client_id=:id 
        return $this->model->select('*','services.id as serviceid','services.service_price as price','user_prices.service_price as clientprice')
        ->leftJoin('user_prices', function($join) use ($user_id)
        {
            $join->on('user_prices.service_id','=','services.id')
            ->where('user_prices.user_id', '=', $user_id);
        })->get();
    }
}
