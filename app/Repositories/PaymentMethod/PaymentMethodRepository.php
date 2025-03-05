<?php
namespace App\Repositories\PaymentMethod;

use App\Repositories\BaseRepository;

class PaymentMethodRepository extends BaseRepository implements PaymentMethodRepositoryInterface
{
    //lấy model tương ứng
    public function getModel()
    {
        return \App\Model\PaymentMethod::class;
    }

    public function getPaymentMethod()
    {
        return $this->model->select('*')->orderBy('method_line','desc')->get();
    }

    public function findMethodGet($id){
        return $this->model->select('*')->where('method_get', $id)->first();
    }

    public function find($id){
        return $this->model->select('*')->where('id', $id)->first();
    }
    
    public function getMethodStatus(){
        return $this->model->select('*')->where('method_type', 2)->orderBy('method_line','desc')->get();
    }
}
