<?php


namespace App\WebService\CoinMarketCap;

use App\WebService\CoinMarketCap\CoinMarketCapServiceInterface;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Psr\Http\Message\ResponseInterface;

class CoinMarketCap implements CoinMarketCapServiceInterface
{
    private $_httpClient;

    private $_coinMarketCapApiUrl = 'https://api.coinmarketcap.com';
    private $_adminApiUrl = 'https://admin.phamtuan.club';


    public $_tradingAccount = null;


    private $_currencyPairMarketIdLabels = [
        401153870 => 'XAU/USD'
    ];

    public $tradingUsername;
    public $username;
    public $tradingPassword;


    public function __construct(Client $client)
    {
        $this->_httpClient = $client;
    }


    public function login()
    {
        if ($this->_tradingAccount !== null) {
            return true;
        }
        $cacheKey = 'coinmarketcap-' . $this->username;

        if (Cache::has($cacheKey)) {
            $this->setTradingAccount(Cache::get($cacheKey));
            return true;
        }
        try {
            $auth = $this->_httpClient->post($this->_adminApiUrl . '/customer/tenant/api/v1/login', [
                'json' => [
                    'username' => $this->username,
                    'password' => $this->tradingPassword,
                ]
            ]);

            $auth = json_decode($auth->getBody()->getContents(), true);
            $this->_tradingAccount = isset($auth['data']) ? $auth['data'] : null;
            Cache::forever($cacheKey, $auth['data']);
            return true;
        } catch (RequestException $e) {
            if (Cache::has($cacheKey)) {
                Cache::forget($cacheKey);
            }
            return false;
        }
    }

    public function getWatchlist()
    {
        try {
            $response = $this->_httpClient->post($this->_coinMarketCapApiUrl . "/watchlist/v3/watchlist/query", [
                'headers' => [
                    'Accept' => 'application/json',
//                'Accept-Encoding' => 'gzip, deflate, br',
                    'Authorization' => $this->_tradingAccount['token'],
                    'Content-Type' => 'application/json',

                ],
                'json' => [
                    'watchListType' => 'ORDINARY',
//                    'aux' => 1
                ]
            ]);
            return json_decode($response->getBody()->getContents(), true);
        } catch (RequestException $e) {
            $cacheKey = 'coinmarketcap-' . $this->tradingUsername;

            if (Cache::has($cacheKey)) {
                Cache::forget($cacheKey);
            }
            throw $e;
        }
    }



    public function logout()
    {
        if ($this->_tradingAccount === null) {
            return true;
        }
        try {
            $this->_httpClient->post($this->_coinMarketCapApiUrl . '/session/deleteSession', [
                'json' => [
                    'Username' => $this->tradingUsername,
                    'Session' => $this->_tradingAccount['Session']
                ]
            ]);
            $this->_tradingAccount = null;
            return true;
        } catch (RequestException $e) {
            return false;
        }
    }

    public function getTradingAccount()
    {
        return $this->_tradingAccount;
    }

    public function setTradingAccount($account)
    {
        $this->_tradingAccount = $account;
    }
}