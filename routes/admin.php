<?php
// Route xử lý cho admin
Route::namespace('Admin')->group(function () {
   Route::get('/login', 'LoginController@showLoginForm');
   Route::post('/login', 'LoginController@login')->name('admin.login');
   Route::get('/logout', 'LoginController@logout')->name('admin.logout');
   Route::get('/confirm', 'ConfirmController@confirm')->name('admin.confirm');
   Route::post('/confirm', 'ConfirmController@postConfirm')->name('admin.postConfirm');

   
   Route::group(['middleware' => ['auth:admin']], function () {
      Route::get('account', 'V1\AdminController@account')->name('admin.account');
      Route::post('account', 'V1\AdminController@changePass')->name('admin.changePass');

      Route::get('error', 'V1\ClientController@checkTotal');
      // 
      Route::get('view-logs/{fileName}', 'V1\AjaxController@viewLog');
      // 
      Route::post('/images', 'V1\ServiceController@images')->name('admin.images');

      Route::get('/', 'V1\ClientController@clients')->name('admin.dashboard');
      Route::get('/settings', array('as' => 'admin.settings', 'uses' => 'V1\SettingController@settings'));
      Route::post('/settings', array('as' => 'admin.post.settings', 'uses' => 'V1\SettingController@postSetting'));

      Route::get('/settings/providers', array('as' => 'admin.providers', 'uses' => 'V1\ProviderController@providers'));
      Route::post('/settings/providers/new', array('as' => 'admin.providers.add', 'uses' => 'V1\ProviderController@store'));
      Route::put('/settings/providers/update/{item?}', array('as' => 'admin.providers.update', 'uses' => 'V1\ProviderController@update'));
      Route::delete('/settings/providers/delete/{item?}', 'V1\ProviderController@destroy')->name('admin.providers.remove');
      // languages
      Route::get('/languages', array('as' => 'admin.languages', 'uses' => 'V1\LanguageController@list'));
      Route::post('/languages/add', array('as' => 'admin.languages.add', 'uses' => 'V1\LanguageController@store'));
      Route::put('/languages/edit/{item?}', array('as' => 'admin.languages.edit', 'uses' => 'V1\LanguageController@update'));
      // languages
      Route::get('/notifications', array('as' => 'admin.notifications', 'uses' => 'V1\NotificationController@list'));
      Route::get('/notifications/new', array('as' => 'admin.notifications.addView', 'uses' => 'V1\NotificationController@addView'));
      Route::post('/notifications/add', array('as' => 'admin.notifications.add', 'uses' => 'V1\NotificationController@store'));
      Route::get('/notifications/edit/{item?}', array('as' => 'admin.notifications.edit', 'uses' => 'V1\NotificationController@editView'));
      Route::put('/notifications/update/{item?}', array('as' => 'admin.notifications.update', 'uses' => 'V1\NotificationController@update'));
      // tasks
      Route::post('/tasks/multi-action', array('as' => 'admin.task.multi-action', 'uses' => 'V1\TaskController@multiAction'));
      // 
      Route::get('/logs', array('as' => 'admin.logs', 'uses' => 'V1\LogController@index'));
      // 

      Route::get('/tasks', array('as' => 'admin.tasks', 'uses' => 'V1\TaskController@list'));
      Route::get('/tasks/no/{item?}', array('as' => 'admin.tasks.no', 'uses' => 'V1\TaskController@taskNo'));
      Route::get('/tasks/success/{item?}', array('as' => 'admin.tasks.success', 'uses' => 'V1\TaskController@success'));
      Route::get('/tasks/canceled/{item?}', array('as' => 'admin.tasks.canceled', 'uses' => 'V1\TaskController@canceled'));
      Route::get('/tasks/refill/{item?}', array('as' => 'admin.tasks.refill', 'uses' => 'V1\TaskController@refill'));
      // services
      Route::get('/services', array('as' => 'admin.services', 'uses' => 'V1\ServiceController@services'));
      Route::get('/services/add', array('as' => 'admin.services.add', 'uses' => 'V1\ServiceController@add'));

      Route::get('/services/edit/{item?}', array('as' => 'admin.edit', 'uses' => 'V1\ServiceController@edit'));
      Route::get('/services/edit/desc/{item?}', array('as' => 'admin.services-desc', 'uses' => 'V1\ServiceController@editDesc'));

      Route::post('/services/multi-action', array('as' => 'admin.multi-action', 'uses' => 'V1\ServiceController@multiAction'));

      Route::post('/services/new-category', array('as' => 'admin.new-category', 'uses' => 'V1\CategoryController@store'));
      Route::put('/services/edit-category/{item?}', array('as' => 'admin.update-category', 'uses' => 'V1\CategoryController@update'));

      Route::get('/services/active-category/{item?}', array('as' => 'admin.active-category', 'uses' => 'V1\CategoryController@activeCategory'));

      Route::get('/services/disable-category/{item?}', array('as' => 'admin.disable-category', 'uses' => 'V1\CategoryController@disableCategory'));
      Route::post('/services/new-service', array('as' => 'admin.new-service', 'uses' => 'V1\ServiceController@store'));
      Route::post('/services/service-sortable', array('as' => 'admin.service-sortable', 'uses' => 'V1\ServiceController@serviceSortable'));
      Route::get('/services/delete-price/{item?}', array('as' => 'admin.delete-price', 'uses' => 'V1\ServiceController@delPrice'));

      Route::get('/services/service-deactive/{item?}', array('as' => 'admin.service-deactive', 'uses' => 'V1\ServiceController@serviceDeactive'));
      Route::get('/services/service-active/{item?}', array('as' => 'admin.service-active', 'uses' => 'V1\ServiceController@serviceActive'));
      Route::put('/services/edit-description/{item?}', array('as' => 'admin.edit-description', 'uses' => 'V1\ServiceController@updateDescription'));
      Route::put('/services/edit-service/{item?}', array('as' => 'admin.edit-service', 'uses' => 'V1\ServiceController@update'));
      Route::post('/services/get-services-add', array('as' => 'admin.get-services-add', 'uses' => 'V1\ServiceController@getServicesAdd'));
      Route::get('/services/delete-service/{item?}', array('as' => 'admin.delete-service', 'uses' => 'V1\ServiceController@destroy'));
      //    client
      Route::get('/clients', array('as' => 'admin.clients', 'uses' => 'V1\ClientController@clients'));
      Route::get('/clients/active/{item?}', array('as' => 'admin.client-active', 'uses' => 'V1\ClientController@active'));
      Route::get('/clients/deactive/{item?}', array('as' => 'admin.client-deactive', 'uses' => 'V1\ClientController@deactive'));
      Route::get('/clients/del-price/{item?}', array('as' => 'admin.client-del-price', 'uses' => 'V1\ClientController@delPrice'));
      Route::put('/clients/edit-price/{item?}', array('as' => 'admin.client-edit-price', 'uses' => 'V1\ClientController@updatePrice'));
      Route::post('/clients/new', array('as' => 'admin.clients-new', 'uses' => 'V1\ClientController@store'));
      Route::get('/clients/client-change-api/{item?}', array('as' => 'admin.client-change-api', 'uses' => 'V1\ClientController@changeApikey'));
      Route::put('/clients/update-user/{item?}', array('as' => 'admin.update-user', 'uses' => 'V1\ClientController@updateUser'));
      Route::put('/clients/update-user-password/{item?}', array('as' => 'admin.update-user-password', 'uses' => 'V1\ClientController@updateUserPassword'));
      //    admins
      Route::get('/users', array('as' => 'admin.users', 'uses' => 'V1\AdminController@index'));
      Route::post('/user/new', array('as' => 'admin.users-new', 'uses' => 'V1\AdminController@store'));
      Route::put('/user/update-user-password/{item?}', array('as' => 'admin.update-admin-password', 'uses' => 'V1\AdminController@updateUserPassword'));
      Route::put('/user/update-user/{item?}', array('as' => 'admin.update-admin', 'uses' => 'V1\AdminController@updateUser'));
      Route::delete('/user/delete/{item?}', 'V1\AdminController@destroy')->name('admin.user.remove');
      // reports
      Route::get('/reports/orders/{string?}', array('as' => 'admin.reports.orders', 'uses' => 'V1\ReportController@orders'));
      Route::post('/reports/orders/{string?}', array('as' => 'admin.reports.orders', 'uses' => 'V1\ReportController@orders'));
      Route::get('/reports/orders/quantity', array('as' => 'admin.reports.orders.quantity', 'uses' => 'V1\ReportController@quantity'));
      Route::post('/reports/orders/quantity', array('as' => 'admin.reports.orders.quantity', 'uses' => 'V1\ReportController@quantity'));

      // payments
      Route::get('/payments', array('as' => 'admin.payments', 'uses' => 'V1\PaymentController@payments'));
      Route::post('/payments/new-online', array('as' => 'admin.payments.new-online', 'uses' => 'V1\PaymentController@store'));
      Route::put('/payments/update-online/{item?}', array('as' => 'admin.payments.update-online', 'uses' => 'V1\PaymentController@update'));


      Route::post('/payments/new-bank', array('as' => 'admin.payments.new-bank', 'uses' => 'V1\PaymentBankController@store'));

      Route::get('/payments/bank', array('as' => 'admin.payments.bank', 'uses' => 'V1\PaymentBankController@banks'));
      // 
      Route::get('/settings/payment-methods', array('as' => 'admin.payment-methods', 'uses' => 'V1\PaymentMethodController@paymentMethods'));
      Route::get('/settings/payment-methods/{id?}', array('as' => 'admin.payment-methods.edit', 'uses' => 'V1\PaymentMethodController@paymentMethodEdit'));
      Route::put('/settings/payment-methods/edit-content/{id?}', array('as' => 'admin.payment-methods.update', 'uses' => 'V1\PaymentMethodController@updateContent'));
      Route::put('/settings/payment-methods/edit/{item?}', array('as' => 'admin.payment-methods-edit', 'uses' => 'V1\PaymentMethodController@update'));
      Route::get('/settings/payment-methods/type', array('as' => 'admin.payment-methods-type', 'uses' => 'V1\PaymentMethodController@type'));
      // bank-accounts
      Route::get('/settings/bank-accounts', array('as' => 'admin.bank-accounts', 'uses' => 'V1\BankAccountController@bankAccounts'));
      Route::post('/settings/bank-accounts/new', array('as' => 'admin.bank-accounts-new', 'uses' => 'V1\BankAccountController@store'));
      Route::put('/settings/bank-accounts/edit/{item?}', array('as' => 'admin.bank-accounts-edit', 'uses' => 'V1\BankAccountController@update'));
      Route::delete('/settings/bank-accounts/delete/{item?}', array('as' => 'admin.bank-accounts-delete', 'uses' => 'V1\BankAccountController@destroy'));
      // api_balance
      Route::get('/api_balance', array('as' => 'admin.api_balance', 'uses' => 'V1\ProviderController@apiBalance'));
      // 
      
      // tickets
      Route::get('/tickets', array('as' => 'admin.tickets', 'uses' => 'V1\TicketController@tickets'));
      Route::get('/tickets/ticket-read/{item?}', array('as' => 'admin.tickets-read', 'uses' => 'V1\TicketController@read'));
      Route::post('/tickets/read/{item?}', array('as' => 'admin.tickets-post-read', 'uses' => 'V1\TicketController@postRead'));
      Route::post('/tickets/new', array('as' => 'admin.tickets-new', 'uses' => 'V1\TicketController@store'));
      Route::put('/tickets/edit/{item?}', array('as' => 'admin.tickets-edit', 'uses' => 'V1\TicketController@update'));
      Route::get('/tickets/delete-reply/{item?}', array('as' => 'admin.tickets-reply-delete', 'uses' => 'V1\TicketController@destroyReply'));
      Route::delete('/tickets/delete/{item?}', array('as' => 'admin.tickets-delete', 'uses' => 'V1\TicketController@destroy'));
      Route::get('/tickets/unread/{item?}', array('as' => 'admin.tickets-unread', 'uses' => 'V1\TicketController@unread'));
      Route::get('/tickets/read/{item?}', array('as' => 'admin.tickets-read-new', 'uses' => 'V1\TicketController@readNew'));
      Route::get('/tickets/lock/{item?}', array('as' => 'admin.tickets-lock', 'uses' => 'V1\TicketController@lock'));
      Route::get('/tickets/unlock/{item?}', array('as' => 'admin.tickets-unlock', 'uses' => 'V1\TicketController@unlock'));
      Route::get('/tickets/close/{item?}', array('as' => 'admin.tickets-close', 'uses' => 'V1\TicketController@close'));
      // orders
      Route::get('/orders', array('as' => 'admin.orders', 'uses' => 'V1\OrderController@orders'));

      Route::get('/no-balance', array('as' => 'admin.no-balance', 'uses' => 'V1\OrderController@noBalance'));

      Route::pattern('string', '([A-Za-z0-9_-]+)');

      Route::get('/orders/order-resend/{item?}', array('as' => 'admin.orders.order-resend', 'uses' => 'V1\OrderController@orderResend'));

      Route::post('/orders/multi-action', array('as' => 'admin.orders.multi-action', 'uses' => 'V1\OrderController@multiAction'));

      Route::get('/orders/1/{string}', array('as' => 'admin.orders.status', 'uses' => 'V1\OrderController@ordersStatus'));
      Route::get('/orders/order_cancel/{item?}', array('as' => 'admin.orders.cancel', 'uses' => 'V1\OrderController@orderCancel'));
      Route::get('/orders/order_complete/{item?}', array('as' => 'admin.orders.complete', 'uses' => 'V1\OrderController@orderComplete'));
      Route::get('/orders/order_inprogress/{item?}', array('as' => 'admin.orders.inprogress', 'uses' => 'V1\OrderController@orderInprogress'));
      Route::get('/orders/order_pending/{item?}', array('as' => 'admin.orders.pending', 'uses' => 'V1\OrderController@orderPendding'));
      Route::put('/orders/update/{item?}', array('as' => 'admin.orders.update', 'uses' => 'V1\OrderController@update'));
      Route::put('/orders/update-partial/{item?}', array('as' => 'admin.orders.update-partial', 'uses' => 'V1\OrderController@updatePartial'));

      Route::post('/orders/counter', array('as' => 'admin.counter', 'uses' => 'V1\OrderController@counter'));
      Route::post('ajax_data', array('as' => 'admin.ajax_data', 'uses' => 'V1\AjaxController@ajaxData'));
   });
});
