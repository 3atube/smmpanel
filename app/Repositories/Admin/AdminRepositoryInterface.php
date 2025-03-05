<?php
namespace App\Repositories\Admin;

use App\Repositories\RepositoryInterface;

interface AdminRepositoryInterface extends RepositoryInterface
{
    public function findAdminLogin($type, $name);
    
    public function getUser();

    public function getPagi($search, $search_type);
}