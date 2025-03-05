<?php

namespace App\Http\Controllers;

use App\User;
use App\Customer;
use Auth;
use Redirect;
use Route;
use Hash;
use App\Model\Theme;
use Illuminate\Http\Request;
use App\Model\Post;
use App\Model\Category;
use App\Model\Rating_Product;
use App\Model\Wishlist;
use App\Model\Addtocard;
use App\Model\Shipping_order;
use App\Model\Customer_forget_pass_otp;
use DB, Input, File;
use Carbon\Carbon;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use App\Libraries\Helpers;
use App\Facades\WebService;


class CustomerController extends Controller
{
    public function index()
    {
       return view('customer.home');
    }
    public function profile(){
    	$data = Auth::user();
    	return view('customer.profile')->with(['data'=>$data]);
    }
    public function updateProfile(Request $rq){
    	$datetime_now=date('Y-m-d H:i:s');
        $datetime_convert=strtotime($datetime_now);
        $id = Auth::user()->id;
        $name_field="avatar_upload";
        if($rq->hasFile($name_field)):
            $file = $rq->file($name_field);
            $timestamp = $datetime_convert;
            $name_avatar = "avatar-".$timestamp. '-' .$file->getClientOriginalName();
            $url_foder_upload="/images/avatar/";
            $file->move(base_path().$url_foder_upload,$name_avatar);
        else:
            $name_avatar = Auth::user()->avatar;
        endif;
        $data= array(
            'name' => $rq->full_name,
            'address' => $rq->address,
            'province' => $rq->slt_province,
            'district' => $rq->slt_district,
            'ward' => $rq->slt_ward,
            'avatar' => $name_avatar,
            'phone' => $rq->phone,
            'about_me' => $rq->about_me,
            'updated_at' => $datetime_now,
        );
        $respons =DB::table('users')->where("id","=",$id)->update($data);
        $msg = "Thông tin tài khoản đã được cập nhật";
        $url=  route('customer.profile');
        Helpers::msg_move_page($msg,$url);
    }
    
    public function logoutCustomer(){
        Auth::logout();
        return redirect()->route('index');
    }
    public function changePassword(){
        return view('customer.changepassword');
    }
    public function postChangePassword(Request $rq){
        $user = Auth::user();
        $id = $user->id;
        $current_pass = $user->password;
        if(Hash::check($rq->current_password, $user->password)){
            if($rq->new_password == $rq->confirm_password){
                $data = array(
                    'password' => bcrypt($rq->new_password)
                );
            } else{
                $msg = 'Mật khẩu xác nhận không trùng khớp';
                return Redirect::back()->withErrors($msg);
            }
        } else{
            $msg = 'Mật khẩu hiện tại không chính xác';
            return Redirect::back()->withErrors($msg);
        }
        $respons =DB::table('users')->where("id","=",$id)->update($data);
        $msg = "Mật khẩu đã được thay đổi";
        $url=  route('customer.dashboard');
        Helpers::msg_move_page($msg,$url);
    }
}
