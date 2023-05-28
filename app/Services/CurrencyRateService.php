<?php

namespace App\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;
use Exception;

class CurrencyRateService
{
    public static function getPrice()
    {
        try {
            $client = new Client();
            $key = env('FAST_FOREX_TRIAL_API_KEY');

            $result = $client->get('https://api.fastforex.io/fetch-one?from=BTC&to=UAH&api_key=' . $key, [
                'headers' => [
                    'accept' => 'application/json',
                ],
            ]);
            $result = json_decode($result->getBody());

            return $result->result->UAH;
        } catch (Exception $exception){
            Log::error('Get rate error: '. $exception->getMessage());

            return 0;
        }
    }
}