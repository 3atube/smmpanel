<?php
namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\User;
use Auth;
use Redirect;
use Route;
use Illuminate\Http\Request;
use DB;
use Input;
use Hash;
use Validator;
use Mail;
use Session;
use App\Model\Service;
use Cart;
use Carbon\Carbon;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Helpers;

class ServiceController extends Controller
{
    public function listApi(Request $request)
    {
        $type = $request->type;
        return Service::getFilterService($type);
    }
    public function list(Request $request, $string)
    {
        switch ($string) {
            case 'like-post-facebook':
                $view = 'front-end.facebook.like-post';
                break;
            case 'follow-facebook':
                $view = 'front-end.facebook.follow';
                break;
            case 'like-fanpage-facebook':
                $view = 'front-end.facebook.like-fanpage';
                break;
            case 'comment-post-facebook':
                $view = 'front-end.facebook.comment-post';
                break;
            case 'like-comment-facebook':
                $view = 'front-end.facebook.like-comment';
                break;
            case 'share-post-facebook':
                $view = 'front-end.facebook.share-post';
                break;
            case 'review-fanpage-facebook':
                $view = 'front-end.facebook.review-fanpage';
                break;
            case 'mat-livestream-facebook':
                $view = 'front-end.facebook.mat-livestream';
                break;
            case 'member-group-facebook':
                $view = 'front-end.facebook.member-group';
                break;
            case 'vip-like-facebook':
                $view = 'front-end.facebook.vip-like';
                break;
            //instagram
            case 'like-instagram':
                $view = 'front-end.instagram.like';
                break;
            case 'comment-instagram':
                $view = 'front-end.instagram.comment';
                break;
            case 'follow-instagram':
                $view = 'front-end.instagram.follow';
                break;
            //
             case 'tim-tiktok':
                $view = 'front-end.tiktok.tim';
                break;
            case 'follow-tiktok':
                $view = 'front-end.tiktok.follow';
                break;
            case 'view-tiktok':
                $view = 'front-end.tiktok.view';
                break;
             //
            case 'like-shopee':
                $view = 'front-end.shopee.like';
                break;
            case 'follow-shopee':
                $view = 'front-end.shopee.follow';
                break;
            default:
                $view = 'front-end.home';
                break;
        }
        return view($view);
    }
    public function store(Request $request)
    {
        $user_id = Auth::user()->id;
        $type = $request->type;
        $action_id = Helpers::get_action_id_by_type($type);
        $reaction = $request->reaction;
        $reaction_id = Helpers::get_reaction_id_by_reaction($reaction) ? Helpers::get_reaction_id_by_reaction($reaction) : 0 ;
        $post_link = $request->post_link;
        
        
        $fanpage_id = $request->fanpage_id;
        if($type=='follow'){
            $post_link = $fanpage_id;
        }
        $guarantee = $request->guarantee ? $request->guarantee : 0;
        $number_seeding = $request->number_seeding;
        $price = $request->price;
        $number = $request->number_seeding;
        $number_done = 0;
        $number_rest = 0;
        $note = $request->note;
        $comments = $request->comments;
        $action = $request->action;
        $coin = $number_seeding*$price;
        $amount = $coin;
        $rules = [
            'type' => 'required',
        ];
        if($type=='follow'){
            $rules = ['fanpage_id'=>'required'];
        }else{
            $rules = ['post_link'=>'required'];
        }
        $messages = [
            'type' => 'Số lượng thực hiện là trường bắt buộc',
            'post_link.required' => 'UID là trường bắt buộc',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return response()->json($validator->errors()->all());
        }
        // chua du tien
        if(Auth::user()->coin < $coin){
            return response()->json([
                'success' => 0,
                'message' => 'Bạn không đủ tiền, vui lòng nạp thêm <a href="">Nạp tiền</a>',
            ]);
        }
        $params = [
            'user_id'=>$user_id,
            'action_id'=>$action_id,
            'type'=>$type,
            'reaction_id'=>$reaction_id,
            'reaction'=>$reaction,
            'post_link'=>$post_link,
            'fanpage_id'=>$fanpage_id,
            'guarantee'=>$guarantee,
            'number_seeding'=>$number_seeding,
            'price'=>$price,
            'coin'=>$coin,
            'number'=>$number,
            'number_rest'=>$number_rest,
            'note'=>$note,
            'number_done'=>$number_done,
            'comments'=>$comments,
            'amount'=>$amount,
            'total'=>$amount,
            'status'=>1,
            'action'=>$action,
        ];
        $first = Service::where('post_link',$post_link)->where('type', $type)->where('amount',$amount)->first();
        if (!$first) {
            $item_service = Service::create($params);
            // tao giao dich
            // tru tien
            $user = User::find($user_id);
            if($user > $user->coin){
                $coin_current = $user->coin-$coin;
                $user->update(['coin'=>$coin_current]);
            }
            // tao log
            // send telegram
            return response()->json([
                'success' => 1,
                'message' => 'Thành công',
            ]);
        }else{
            return response()->json([
                'success' => 0,
                'message' => 'Thất bại',
            ]);
        }
        
    }
}