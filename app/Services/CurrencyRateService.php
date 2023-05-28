<?php

namespace App\Services;

use GuzzleHttp\Client;
class CurrencyRateService
{
    public static function getPrice()
    {
        $client = new Client();
        $key = env('FAST_FOREX_TRIAL_API_KEY');

        $result = $client->get('https://api.fastforex.io/fetch-one?from=BTC&to=UAH&api_key=' . $key , [
            'headers' => [
                'accept'=> 'application/json',
            ],
        ]);
        $result = json_decode($result->getBody());

        return $result->result->UAH;
    }
}