<?php

use App\Http\Controllers\TelegramController;
use Illuminate\Support\Facades\Route;

Route::post('/sendtochat', [TelegramController::class, 'sendToChat']);