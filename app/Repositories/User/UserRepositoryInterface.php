<?php
namespace App\Repositories\User;

use App\Repositories\RepositoryInterface;

interface UserRepositoryInterface extends RepositoryInterface
{
    //ví dụ: lấy 5 sản phầm đầu tiên

    public function findUserLogin($type, $name);
    
    public function getUser();

    public function findUserByKey($key);

    public function getUserByName($name);

    public function getUserPagi($search, $search_type);
}