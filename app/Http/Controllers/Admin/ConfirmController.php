<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Validator, Redirect, Session;
use App\Repositories\Admin\AdminRepositoryInterface;

class ConfirmController extends Controller
{
  protected $adminRepository;

  public function __construct(AdminRepositoryInterface $adminRepository)
  {
    $this->adminRepository = $adminRepository;
  }


  public function confirm()
  {
    $email = Session::get('email_admin');
    $password = Session::get('password_admin');
    Auth::guard('admin')->logout();
    if (!$email && !$password) {
      return redirect()->route('admin.login');
    }
    return view('admin-view.2fa', compact('email'));
  }

  public function postConfirm(Request $request)
  {
    $email = Session::get('email_admin');
    $password = Session::get('password_admin');
    $code = $request->verify_code;
    $validation_rules = array(
      'verify_code' => 'required|min:6',
    );
    $messages = array(
      'verify_code.required' => 'Please enter your code',
      'verify_code.min' => 'Password minimum 6 characters',
    );
    $validator = Validator::make($request->all(), $validation_rules, $messages);
    if ($validator->fails()) {
      return  Redirect::back()->withErrors($validator);
    }
    $admin = $this->adminRepository->findAdminLogin('email', $email);
    if ($admin->verify_code == $code) {
      $ipLogin = !empty($_SERVER['HTTP_X_FORWARDED_FOR']) ? @$_SERVER['HTTP_X_FORWARDED_FOR'] : @$_SERVER['REMOTE_ADDR'];
      $admin->ip_login = $ipLogin;
      $admin->save();
      // login
      Auth::guard('admin')->attempt(['email' => $email, 'password' => $password]);
      return redirect()->route('admin.clients');
    } else {
      return redirect()->back()->with('status', 'Wrong code!');
    }
  }
}
