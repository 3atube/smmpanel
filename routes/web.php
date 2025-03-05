<?php

use Illuminate\Support\Facades\Route;
use App\Mail\AmazonSes;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//site map
// site
Route::group(['prefix' => 'sitemap-index', 'as' => 'sitemap.'], function () {
    Route::get('/', array('as' => 'index', 'uses' => 'SitemapController@Home'));
    Route::get('/static.xml', array(
        'as' => 'static',
        'uses' => 'SitemapController@mapStatic'
    ));
    Route::get('/page.xml', array(
        'as' => 'page',
        'uses' => 'SitemapController@Page'
    ));
    Route::get('/post.xml', array(
        'as' => 'post',
        'uses' => 'SitemapController@Post'
    ));
    Route::get('/cat_post.xml', array(
        'as' => 'cat_post',
        'uses' => 'SitemapController@CatPost'
    ));
    Route::get('/theme.xml', array(
        'as' => 'theme',
        'uses' => 'SitemapController@Theme'
    ));
    Route::get('/cat_theme.xml', array(
        'as' => 'cat_theme',
        'uses' => 'SitemapController@CatTheme'
    ));
});


Auth::routes();

//user forget password
Route::get('forget-password', 'HomeController@forgetPassword')->name('forgetPassword');
Route::post('forget-password', 'HomeController@actionForgetPassword')->name('actionForgetPassword');
Route::get('forget-password-step-2', 'HomeController@forgetPassword_step2')->name('forgetPassword_step2');
Route::post('forget-password-step-2', 'HomeController@actionForgetPassword_step2')->name('actionForgetPassword_step2');
Route::get('forget-password-step-3', 'HomeController@forgetPassword_step3')->name('forgetPassword_step3');
Route::post('forget-password-step-3', 'HomeController@actionForgetPassword_step3')->name('actionForgetPassword_step3');
//social login
Route::get('auth/facebook', 'FacebookAuthController@redirectToProvider')->name('facebook.login');
Route::get('auth/facebook/callback', 'FacebookAuthController@handleProviderCallback');

Route::get('/auth/{provider}', 'SocialAuthController@redirectToProvider')->name('google.login');
Route::get('/auth/{provide}/callback', 'SocialAuthController@handleProviderCallback');
//customer
Route::get('dang-nhap/zalo', 'Auth\LoginZaloController@login_zalo')->name('customer.login.login_zalo');
Route::get('dang-nhap/zalo/callback', 'Auth\LoginZaloController@callback_zalo')->name('customer.login.callback_zalo');
Route::get('/account/register', array('as' => 'registerCustomer', 'uses' => 'HomeController@registerCustomer'));
Route::post('/account/register', array('as' => 'postRegisterCustomer', 'uses' => 'HomeController@createCustomer'));
Route::get('/account/login', array('as' => 'user.login', 'uses' => 'HomeController@showLoginForm'));
Route::post('/account/login', array('as' => 'loginCustomerAction', 'uses' => 'HomeController@postLogin'));
Route::post('account/logout', ['as'  => 'CustomerLogout', 'uses' => 'Frontend\CustomerLoginController@logout']);



// frontend
Route::get('/', 'Frontend\HomeController@index')->name('index');
Route::get('/insert', 'Frontend\HomeController@insert')->name('insert');

Route::get('/signup', 'Frontend\HomeController@signup')->name('home.signup');
Route::get('/services', 'Frontend\HomeController@listServices')->name('home.services');
Route::get('/api', 'Frontend\HomeController@listApi')->name('home.api');

Route::get('/details-service', 'Frontend\HomeController@detailsService')->name('home.details-service');


// 
Route::post('perfectmoney/success', 'Frontend\PerfectMoneyController@success')->name('perfectmoney.success');
Route::post('perfectmoney/fail', 'Frontend\PerfectMoneyController@fail')->name('perfectmoney.fail');
Route::post('perfectmoney/status', 'Frontend\PerfectMoneyController@status')->name('perfectmoney.status');
//
Route::get('payeer/success', 'Frontend\PayeerController@success')->name('payeer.success');
Route::get('payeer/fail', 'Frontend\PayeerController@fail')->name('payeer.fail');
Route::get('payeer/status', 'Frontend\PayeerController@status')->name('payeer.status');

// 
Route::get('paypal/status', 'Frontend\PaymentController@getPaymentStatus')->name('paypal.status');

Route::group(['prefix' => '/', 'middleware' => [
    'auth',
]], function () {
    
    Route::post('request', 'Frontend\RequestController@request')->name('request');
    Route::get('/massorder', 'Frontend\HomeController@massOrder')->name('massorder');
    Route::get('/orders', 'Frontend\HomeController@history')->name('orders');
    Route::get('/order', 'Frontend\HomeController@order')->name('order');
    // Route::get('/services', 'Frontend\HomeController@services')->name('services');
    Route::get('/history', 'Frontend\HomeController@history')->name('history');
    Route::get('/cashflow', 'Frontend\CashFlowController@cashflow')->name('cashflow');
    Route::get('/addfunds', 'Frontend\HomeController@addfunds')->name('addfunds');
    Route::get('/api-document', 'Frontend\HomeController@api')->name('api');
    // 
    Route::get('account', 'Frontend\HomeController@account')->name('account.index');
    Route::post('account', 'Frontend\AccountController@accountPost')->name('account.accountPost');
    Route::post('account/newkey', 'Frontend\AccountController@newkey')->name('account.newkey');

    Route::post('history', 'Frontend\AccountController@history')->name('account.history');
    Route::post('upload-avatar', 'Frontend\AccountController@uploadAvatar')->name('account.upload-avatar');

    // rating
    Route::post('submit-rating', 'Frontend\AccountController@submitRating')->name('account.submit-rating');
    Route::post('submit-load-data', 'Frontend\AccountController@submitLoadData')->name('account.submit-load-data');
    Route::get('review-servive/{item?}', 'Frontend\AccountController@serviveReview')->name('account.review-servive');
    Route::get('pricing', 'Frontend\HomeController@pricing')->name('account.pricing');

    // payment
    Route::get('momo', 'Frontend\PaymentController@momo')->name('account.momo');
    Route::get('bank', 'Frontend\PaymentController@bank')->name('account.bank');
    Route::get('card', 'Frontend\PaymentController@card')->name('account.card');
    Route::post('payeer', 'Frontend\PayeerController@form')->name('account.payeer');
    Route::post('/method-payment', 'Frontend\PaymentMethodController@change')->name('method-payment');
    // 
    Route::get('tickets', 'Frontend\TicketController@tickets')->name('account.messages');
    Route::post('ticket-send', 'Frontend\TicketController@ticketSend')->name('account.ticket-send');
    Route::get('viewticket/{item?}', 'Frontend\TicketController@viewTicket')->name('account.view-ticket');
    Route::post('reply-ticket/{item?}', 'Frontend\TicketController@replyTicket')->name('account.reply-ticket');
    // task
    Route::post('add-task', 'Frontend\TaskController@addTask')->name('account.add-task');

    // facebook
    Route::group(['prefix' => 'tool', 'middleware' => [
        'auth',
    ]], function () {
        Route::get('service', 'Frontend\ServiceController@listApi')->name('account.listApi');

        Route::pattern('string', '([A-Za-z0-9_-]+)');
        Route::get('{string}', 'Frontend\ServiceController@list')->name('account.service.list');
        // lay button khi click vao 1 button nhiem vu
        Route::post('service', 'Frontend\ServiceController@store')->name('account.service');
    });

    Route::post('addmoney-paypal', 'Frontend\PaymentController@payWithpaypal')->name('addmoney.paypal');
});
Route::get('member/login/{id}', array(
    'as' => 'login_home',
    'uses' => 'Frontend\HomeController@login'
));

Route::post('webhook/casso', 'WebhookController@webHookCasso')->name('webhook');
Route::get('/webhook/casso', function (Request $request) {
    return '';
});