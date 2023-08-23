<?php

use App\Http\Controllers\TelegramController;
use Illuminate\Support\Facades\Route;

Route::post('/webhook', [TelegramController::class, 'handle']);
Route::get('/webhook', [TelegramController::class, 'setWebhook']);




// Route::get('/bot/sendbuttons', [TelegramController::class, 'sendButtons']);
// Route::get('/bot/sendmessage', function () {
//     return view('sendmessage');
// });

// Route::get('/bot/getwebhook', function () {
//     $webhookInfo = Telegram::getWebhookInfo();
//     dd($webhookInfo);
// });