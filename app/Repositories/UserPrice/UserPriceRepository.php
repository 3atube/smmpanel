<?php
namespace App\Repositories\UserPrice;

use App\Repositories\BaseRepository;

class UserPriceRepository extends BaseRepository implements UserPriceRepositoryInterface
{
    //lấy model tương ứng
    public function getModel()
    {
        return \App\Model\UserPrice::class;
    }

    public function getUserPrice()
    {
        return $this->model->select('*')->orderBy('id','asc')->get();
    }

    public function findUserPriceByKey($key)
    {
        return $this->model->select('*')->where('key_api', $key)->first();
    }

    public function deletePrice($service_id, $user_id){
        return $this->model->where('user_id', $user_id)->where('service_id', $service_id)->delete();
    }

    public function deleteService($service_id){
        return $this->model->where('service_id', $service_id)->delete();
    }

    public function deleteServiceUser($user_id){
        return $this->model->where('user_id', $user_id)->delete();
    }

    public function deleteServices($services){
        return $this->model->whereIn('service_id', $services)->delete();
    }

    public function findPrice($service_id, $user_id){
        return $this->model->where('user_id', $user_id)->where('service_id', $service_id)->first();
    }

    public function countPrice($user_id){
        return $this->model->join('services','services.id','=','user_prices.service_id')->where('user_prices.user_id', $user_id)->count();
    }
}