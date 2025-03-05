<?php
namespace App\Repositories\Language;

use App\Repositories\RepositoryInterface;

interface LanguageRepositoryInterface extends RepositoryInterface
{
    //ví dụ: lấy 5 sản phầm đầu tiên
    public function getLanguage();
}
