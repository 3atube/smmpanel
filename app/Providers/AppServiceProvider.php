<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Validator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(
            \App\Repositories\Service\ServiceRepositoryInterface::class,
            \App\Repositories\Service\ServiceRepository::class,
        );

        $this->app->singleton(
            \App\Repositories\Order\OrderRepositoryInterface::class,
            \App\Repositories\Order\OrderRepository::class,
        );

        $this->app->singleton(
            \App\Repositories\CashFlow\CashFlowRepositoryInterface::class,
            \App\Repositories\CashFlow\CashFlowRepository::class,
        );

        $this->app->singleton(
            \App\Repositories\User\UserRepositoryInterface::class,
            \App\Repositories\User\UserRepository::class,
        );

        $this->app->singleton(
            \App\Repositories\Provider\ProviderRepositoryInterface::class,
            \App\Repositories\Provider\ProviderRepository::class,
        );

        $this->app->singleton(
            \App\Repositories\Category\CategoryRepositoryInterface::class,
            \App\Repositories\Category\CategoryRepository::class,
        );

        $this->app->singleton(
            \App\Repositories\UserPrice\UserPriceRepositoryInterface::class,
            \App\Repositories\UserPrice\UserPriceRepository::class,
        );

        $this->app->singleton(
            \App\Repositories\PaymentMethod\PaymentMethodRepositoryInterface::class,
            \App\Repositories\PaymentMethod\PaymentMethodRepository::class,
        );
        
        $this->app->singleton(
            \App\Repositories\Payment\PaymentRepositoryInterface::class,
            \App\Repositories\Payment\PaymentRepository::class,
        );

        $this->app->singleton(
            \App\Repositories\Ticket\TicketRepositoryInterface::class,
            \App\Repositories\Ticket\TicketRepository::class,
        );

        $this->app->singleton(
            \App\Repositories\BankAccount\BankAccountRepositoryInterface::class,
            \App\Repositories\BankAccount\BankAccountRepository::class,
        );

        $this->app->singleton(
            \App\Repositories\TicketReply\TicketReplyRepositoryInterface::class,
            \App\Repositories\TicketReply\TicketReplyRepository::class,
        );

        $this->app->singleton(
            \App\Repositories\ServiceReview\ServiceReviewRepositoryInterface::class,
            \App\Repositories\ServiceReview\ServiceReviewRepository::class,
        );

        $this->app->singleton(
            \App\Repositories\Task\TaskRepositoryInterface::class,
            \App\Repositories\Task\TaskRepository::class,
        );

        $this->app->singleton(
            \App\Repositories\Language\LanguageRepositoryInterface::class,
            \App\Repositories\Language\LanguageRepository::class,
        );

        $this->app->singleton(
            \App\Repositories\Notification\NotificationRepositoryInterface::class,
            \App\Repositories\Notification\NotificationRepository::class,
        );

        $this->app->singleton(
            \App\Repositories\Admin\AdminRepositoryInterface::class,
            \App\Repositories\Admin\AdminRepository::class,
        );

        if(env('APP_ENV') === 'production'){
            \URL::forceScheme('https');
        }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Validator::extend('recaptcha', 'App\Validators\ReCaptcha@validate');
        //
    }
    
}
