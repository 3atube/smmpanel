<?php

namespace App\WebService\CoinMarketCap;

interface CoinMarketCapServiceInterface
{
    /**
     * @return void
     */
    public function login();

    /**
     * @return void
     */
    public function logout();
}