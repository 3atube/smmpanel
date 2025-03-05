<?php

namespace App\Console\Commands;

use App\WebService\CIApi\CIApiTradingService;
use App\WebService\CoinMarketCap\CoinMarketCapServiceInterface;
use GuzzleHttp\Exception\InvalidArgumentException;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;
use Illuminate\Validation\UnauthorizedException;

class CoinMarketInsertWatchList extends Command
{
    protected $coinMarketCapService;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'coinmarket:insert_watchlist';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command Insert Coin Watchlist';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(CoinMarketCapServiceInterface $coinMarketCapService)
    {
        parent::__construct();

        $this->coinMarketCapService = $coinMarketCapService;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //

        $this->coinMarketCapService->tradingUsername = 'mtuan2356@gmail.com';
        $this->coinMarketCapService->tradingPassword = 'Anhtuan@8010';
        $this->coinMarketCapService->username = 'mtuan2356';
        if (! ($login = $this->coinMarketCapService->login())) {
            throw new AuthenticationException('Unauthenticated');
        }
       
        $storage = Cache::get('coinmarketcap-mtuan2356');
       

        dd($this->coinMarketCapService);
        try {
            $model = "App\CtDetailDataCoin";

            $response = $this->coinMarketCapService->getWatchlist();


            if (!empty($response['data']['watchLists'])) {
                $watchLists = $response['data']['watchLists'];

                foreach ($watchLists as $watchList) {//one or more watch list
                    //list crypto of a watch list
                    foreach ($watchList['cryptoCurrencies'] as $crypto) {
                        $id =  strtotime($crypto['lastUpdated']);
                        $quotes = $crypto['quotes'][0];

                        $model::updateOrCreate(['id' => $id, 'crypto' => $crypto['name']], [
                            'id' => $id,
                            'crypto' => $crypto['name'],
                            'price' => $quotes['price'],
                            '24h' => $quotes['percentChange24h'],
                            '7d' => $quotes['percentChange7d'],
                            'market_cap' => $quotes['marketCap'],
                            'volumn_24h_usd' => $quotes['volume24h'],
                            'volumn_24h_coin' => (float) ($quotes['volume24h']/$quotes['price']),
                            'circle_supply' => $crypto['circulatingSupply'],

                        ]);
                    }
                }
            }
        } catch (RequestException $e) {
            throw new RequestException($e->getMessage());
        }
    }
}