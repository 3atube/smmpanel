<?php
namespace App\Repositories\Provider;

use App\Repositories\RepositoryInterface;

interface ProviderRepositoryInterface extends RepositoryInterface
{
    //ví dụ: lấy 5 sản phầm đầu tiên
    public function getProvider();
}