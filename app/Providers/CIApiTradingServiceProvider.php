<?php

namespace App\Providers;

use App\WebService\CIApi\CIApiTradingService;
use App\WebService\CIApi\CIApiTradingServiceInterface;
use App\WebService\CoinMarketCap\CoinMarketCap;
use App\WebService\CoinMarketCap\CoinMarketCapServiceInterface;
use Illuminate\Support\ServiceProvider;

class CIApiTradingServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        // $this->app->singleton(CIApiTradingServiceInterface::class, CIApiTradingService::class);
        $this->app->singleton(CoinMarketCapServiceInterface::class, CoinMarketCap::class);
    }
}