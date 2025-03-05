<?php

namespace App\WebService;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Libraries\Helpers;
use Illuminate\Pagination\Paginator;
use Route, HTML, Crypt, Config, DateTime, Image, Cache, Session, DB, Carbon\Carbon;
use Illuminate\Support\Str;
use Harimayco\Menu\Facades\Menu;
use App\Model\Log;
use App\User;
use Auth;
use Cart;
use App\Repositories\Service\ServiceRepositoryInterface; 

class WebService {
    private $serviceRepository;

    public function __construct(ServiceRepositoryInterface $serviceRepository){
        $this->serviceRepository = $serviceRepository;
    }

    public function getSEO($data = array()){
        $seo = array();
        $seo['title'] = isset($data['title'])?$data['title']:'';
        $seo['keywords'] = isset($data['keywords'])?$data['keywords']:'';
        $seo['description'] = isset($data['description'])?$data['description']:'';
        $seo['og_title'] = isset($data['og_title'])?$data['og_title']:'';
        $seo['og_description'] = isset($data['og_description'])?$data['og_description']:'';
        $seo['og_url'] = isset($data['og_url'])?$data['og_url']:'';
        $seo['og_img'] = isset($data['og_img'])?$data['og_img']:'';
        $seo['current_url'] = isset($data['current_url'])?$data['current_url'] : '';
        $seo['current_url_amp'] = isset($data['current_url_amp'])?$data['current_url_amp'] :'';
        return $seo;
    }//end function
    public function create_log_system($title, $module, $action, $id_account)
    {
        $knotModules = config('chowordpress.modules');
        $knotActions = config('chowordpress.actions');
        $module_name = $knotModules[$module];
        $log = new Log();
        $log->name = $knotActions[$action];

        $user = User::find($id_account);
        $id = @$user->id;
        $author = @$user->id . ' - ' . @$user->email;
        if ($id_account == -1) {
            $author = 'Hệ thống';
        }
        switch ($knotActions[$action]) {
            case $knotActions['store']:
                $log->message = $author . ' đã thêm ' . $module_name . ': ' . $title;
                break;
            case $knotActions['update']:
                $log->message = $author . ' đã cập nhật ' . $module_name . ': ' . $title;
                break;
            case $knotActions['destroy']:
                $log->message = $author . ' đã xóa ' . $module_name . ': ' . $title;
                break;
            case $knotActions['trash']:
                $log->message = $author . ' đã xóa tạm ' . $module_name . ': ' . $title;
                break;
            case $knotActions['removeAll']:
                $log->message = $author . ' đã xóa tất cả ' . $module_name;
                break;
            case $knotActions['changeList']:
                $log->message = $author . ' thay đổi danh sách ' . $module_name;
                break;
            case $knotActions['approved']:
                $log->message = $author . ' đã phê duyệt ' . $title;
                break;
            case $knotActions['not_approved']:
                $log->message = $author . ' không phê duyệt ' . $title;
                break;
            case $knotActions['status_plus']:
                $log->message = 'Hệ thống đã Bù xu ' . $title;
                break;
            case $knotActions['invoice_order']:
                $log->message = $title;
                break;
            default:
                return;
        }
        $log->module = $module_name;
        $log->author = $id_account;

        $log->save();
    }
}//end class
