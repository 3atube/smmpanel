<?php
namespace App\Repositories\Category;

use App\Repositories\BaseRepository;

class CategoryRepository extends BaseRepository implements CategoryRepositoryInterface
{
    //lấy model tương ứng
    public function getModel()
    {
        return \App\Model\Category::class;
    }

    public function getCategory()
    {
        return $this->model->select('*')->orderBy('category_line','asc')->get();
    }

    public function getCategoryLine(){
        $last = $this->model->select('category_line')->orderBy('category_line','desc')->first();
        if(!$last){
            return 1;
        }
        return $last->category_line+1;
    }
}