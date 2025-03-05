<?php
namespace App\Repositories\ServiceReview;

use App\Repositories\BaseRepository;
use DB;
use Carbon\Carbon;


class ServiceReviewRepository extends BaseRepository implements ServiceReviewRepositoryInterface
{
    //lấy model tương ứng
    public function getModel()
    {
        return \App\Model\ServiceReview::class;
    }

    public function getServiceReview($user_id)
    {
        return $this->model->select('*')->where('user_id', $user_id)->orderBy('id','asc')
        ->where('created_at', '>', now()->subDays(30)->endOfDay())->get();
    }

    public function findService($service_id)
    {
        return $this->model->select('*')->where('service_id', $service_id)->orderBy('id', 'desc')
        ->where('created_at', '>', now()->subDays(30)->endOfDay())->get();
    }

    public function ratingService($service_id){
        return $this->model->select(DB::raw('sum(user_rating) as rating'), DB::raw('count(user_rating) as count'))->where('service_id', $service_id)
        ->where('created_at', '>', now()->subDays(30)->endOfDay())->first();
    }

    public function reviewUser($user_id, $service_id)
    {
        return $this->model->select('id')->where('user_id', $user_id)->where('service_id', $service_id)
        ->where('created_at', '>', now()->subDays(30)->endOfDay())->count();
    }

    public function findServiceReview($service_id)
    {
        return $this->model->where('service_id', $service_id)
        ->where('created_at', '>', now()->subDays(30)->endOfDay())->pluck('user_id')->toArray();
    }
}