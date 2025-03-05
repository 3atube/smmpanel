<?php
namespace App\Repositories\Provider;

use App\Repositories\BaseRepository;

class ProviderRepository extends BaseRepository implements ProviderRepositoryInterface
{
    //lấy model tương ứng
    public function getModel()
    {
        return \App\Model\Provider::class;
    }

    public function getProvider()
    {
        return $this->model->select('*')->orderBy('id','desc')->get();
    }
}