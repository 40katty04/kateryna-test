<?php

namespace App\Services;

use GuzzleHttp\Client;
class CurrencyRateService
{
    public static function getPrice()
    {
        $price = 956745.21;

        return $price;
    }
}