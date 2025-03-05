<?php

namespace App\Repositories\User;

use App\Repositories\BaseRepository;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    //lấy model tương ứng
    public function getModel()
    {
        return \App\User::class;
    }

    public function findUserLogin($type, $name)
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

    public function getUserByName($name)
    {
        return $this->model->select('*')->where('name', $name)->first();
    }

    public function findUserByKey($key)
    {
        return $this->model->select('*')->where('key_api', $key)->first();
    }

    public function getUserPagi($search, $search_type)
    {
        $this->model = $this->model->select('*');
        if(!empty($search) && !empty($search_type)){
            switch ($search_type) {
                case 'username':
                    $this->model = $this->model->where('name', 'like', '%'.$search.'%');
                    break;
                case 'email':
                    $this->model = $this->model->where('email', 'like', '%'.$search.'%');
                    break;
                case 'telephone':
                    $this->model = $this->model->where('phone', 'like', '%'.$search.'%');
                    break;
    
                default:
                $this->model = $this->model->where('name', 'like', '%'.$search.'%');
                    break;
            }
        }
        
        return $this->model->orderBy('id', 'desc')->paginate(20);
    }
}
