<?php

namespace App\Http\Controllers;

use App\Models\Users;
use App\Services\CurrencyRateService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{
    public function subscribe(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email'
        ]);

        $email = $request->input('email');

        $subscribedEmails = Users::getAll();

        if(in_array($email, $subscribedEmails)){
            return $this->jsonResponse('Email is already subscribed', 409);
        }

        Users::add($email);

        return $this->jsonResponse('You are successfully subscribed');
    }

    public function rate()
    {
        $rate = CurrencyRateService::getPrice();

        return $rate > 0
            ? $this->jsonResponse($rate)
            : $this->jsonResponse('Invalid status', 400);
    }

    public function sendEmails()
    {
        $emails = Users::getAll();
        $rate = CurrencyRateService::getPrice();
        foreach ($emails as $email) {
            $message = '1 BTC = ' . $rate . ' UAH';
            Mail::raw($message, function ($message) use ($email) {
                $message->to($email)
                    ->subject('BTC rate');
            });
        }
        return $this->jsonResponse("Emails was sent successfully");
    }

    private function jsonResponse($data, $status = 200)
    {
        return response()->json($data, $status);
    }

}
