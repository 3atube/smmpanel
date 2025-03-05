<?php
namespace App\Repositories\ServiceReview;

use App\Repositories\RepositoryInterface;

interface ServiceReviewRepositoryInterface extends RepositoryInterface
{
    //ví dụ: lấy 5 sản phầm đầu tiên
    public function getServiceReview($user_id);

    public function findService($service_id);

    public function reviewUser($user_id, $service_id);

    public function ratingService($service_id);
}