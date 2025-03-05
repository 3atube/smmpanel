<?php

namespace App\Repositories\Admin;

use App\Repositories\BaseRepository;

class AdminRepository extends BaseRepository implements AdminRepositoryInterface
{
    //lấy model tương ứng
    public function getModel()
    {
        return \App\Model\Admin::class;
    }

    public function findAdminLogin($type, $name)
    {
        return $this->model->select('*')->when($type=='email', function ($q) use ($name) {
            return $q->where('email', $name);
        })
        ->when($type=='name', function ($q) use ($name) {
            return $q->where('name', $name);
        })->first();
    }

    public function getUser()
    {
        return $this->model->select('*')->orderBy('id', 'asc')->get();
    }

    public function getPagi($search, $search_type)
    {
        return $this->model = $this->model->select('*')->where('name','!=','admins')->when($search_type=='name', function ($q) use ($search) {
            return $q->where('name', 'like', '%'.$search.'%');
        })
        ->when($search_type=='email', function ($q) use ($search) {
            return $q->where('email', 'like', '%'.$search.'%');
        })->orderBy('id', 'desc')->paginate(20);
    }
}
