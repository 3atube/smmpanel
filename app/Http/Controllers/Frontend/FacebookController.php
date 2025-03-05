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
use App\Model\Addtocard;
use Cart;
use Carbon\Carbon;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;


class FacebookController extends Controller
{
    public function likePostFacebook(Request $request){
        return view('front-end.facebook.like-post');
    }
}