<?php
namespace App\Repositories\Language;

use App\Repositories\BaseRepository;

class LanguageRepository extends BaseRepository implements LanguageRepositoryInterface
{
    //lấy model tương ứng
    public function getModel()
    {
        return \App\Model\Language::class;
    }

    public function getLanguage()
    {
        return $this->model->select('*')->orderBy('id','desc')->paginate(20);
    }
}
