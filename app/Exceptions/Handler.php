<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Telegram\Bot\Laravel\Facades\Telegram;
use Throwable;

class Handler extends ExceptionHandler
{
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            $data = [
                'description' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
            ];

            Telegram::sendMessage([
                'chat_id' => '1117894175',
                'parse_mode' => 'HTML',
                'text' => (string)view('report', $data)
            ]);
        });
    }
}
