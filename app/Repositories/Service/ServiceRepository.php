<?php
namespace App\Repositories\Service;

use App\Repositories\BaseRepository;

class ServiceRepository extends BaseRepository implements ServiceRepositoryInterface
{
    //lấy model tương ứng
    public function getModel()
    {
        return \App\Model\Service::class;
    }

    public function getService()
    {
        return $this->model->select('*')->where('service_type', 2)
        ->orderBy('category_id','asc')->orderBy('service_line','asc')->get();
    }

    public function countServiceByCategory($categoryId)
    {
        return $this->model->select('id')->where('service_type', 2)
        ->where('category_id', $categoryId)->count();
    }

    public function updateServiceCategoryLine($categoryId, $line){
        return $this->model->select('*')->where('category_id', $categoryId)->update(['category_line' => $line]);
    }

    public function getServiceUser($userId)
    {
        return $this->model->select('services.*','services.id as serviceid','services.service_price as price','user_prices.service_price as clientprice')
        ->leftJoin('user_prices', function($join) use ($userId)
        {
            $join->on('user_prices.service_id','=','services.id')
            ->where('user_prices.user_id', '=', $userId);
        })->where('services.service_type', 2)->orderBy('services.category_line','asc')->orderBy('services.service_line','asc')->get();
    }

    public function getServiceByCategory($category)
    {
        return $this->model->select('*')->where('category_id', $category)
        ->orderBy('category_id','asc')->orderBy('service_line','asc')->get();
    }

    public function getLastLine($category)
    {
        $last = $this->model->select('service_line', 'category_id')->where('category_id', $category)->orderBy('service_line','desc')->first();
        if(!$last){
            return 1;
        }
        return $last->service_line+1;
    }
    
    public function updateLineService($category, $line){
        return $this->model->select('*')->where('category_id', $category)->where('service_line', '>=', $line)->get();
    }

    public function removeByCategory($category){
        return $this->model->select('*')->where('category_id', $category)->delete();
    }

    public function getServiceUserPrice($userId){
        return $this->model->select('services.*','services.id as serviceid','services.service_price as price','user_prices.service_price as clientprice')
        ->leftJoin('user_prices', function($join) use ($userId)
        {
            $join->on('user_prices.service_id','=','services.id')
            ->where('user_prices.user_id', '=', $userId);
        })->get();
    }

    public function firstServiceUserPrice($userId, $serviceId){
        return $this->model->select('services.*','services.id as serviceid','services.service_price as price','user_prices.service_price as clientprice')
        ->leftJoin('user_prices', function($join) use ($userId)
        {
            $join->on('user_prices.service_id','=','services.id')
            ->where('user_prices.user_id', '=', $userId);
        })->where('services.id', $serviceId)->where('services.service_type', 2)->first();
    }

    public function typeServices($services, $serviceType)
    {
        return $this->model->select('*')->whereIn('id',$services)->update(['service_type' => $serviceType]);
    }

    public function secretServices($services, $serviceSecret)
    {
        return $this->model->select('*')->whereIn('id',$services)->update(['service_secret' => $serviceSecret]);
    }

    public function deleteServices($services){
        return $this->model->select('*')->whereIn('id',$services)->delete();
    }
    
}
