<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class BrevoMailService
{
    public static function sendEmail($to, $subject, $htmlContent)
    {
        return Http::withHeaders([
            'api-key' => env('BREVO_API_KEY'),
            'Content-Type' => 'application/json',
            'accept' => 'application/json',
        ])->post('https://api.brevo.com/v3/smtp/email', [
            'sender' => [
                'name' => env('MAIL_FROM_NAME'),
                'email' => env('MAIL_FROM_ADDRESS'),
            ],
            'to' => [
                ['email' => $to]
            ],
            'subject' => $subject,
            'htmlContent' => $htmlContent,
        ]);
    }
}
