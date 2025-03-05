<?php
namespace App\Repositories\Service;

use App\Repositories\RepositoryInterface;

interface ServiceRepositoryInterface extends RepositoryInterface
{
    //ví dụ: lấy 5 sản phầm đầu tiên
    public function getService();

    public function updateServiceCategoryLine($categoryId, $line);

    public function getServiceByCategory($category);

    public function getLastLine($category);
    
    public function updateLineService($category, $line);

    public function getServiceUserPrice($userId);

    public function firstServiceUserPrice($userId, $serviceId);

    public function removeByCategory($category);
}
