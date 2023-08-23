<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Telegram\Bot\Laravel\Facades\Telegram;

class TelegramController extends Controller
{
    public function handle(Request $req)
    {
        $update = json_decode($req->getContent());

        if (isset($update->message)) {
            if (isset($update->message->chat->title) && $update->message->chat->title === 'Chat') {

                $text = $update->message->from->username . ': ' .  $update->message->text;

                $res = Http::withHeaders([
                    'Authorization' => 'Bearer 24|zXCtS7rHX45qNPxBkqzxfIjNdb52Uh9yExtXJ4YL',
                ])->post('http://127.0.0.1:8000/api/chat', [
                    'username' => $update->message->from->username,
                    'message' => $update->message->text,
                ]);

                Log::debug($text);

                return;
            }
        }

        Log::debug('Not in the Chat or something');
    }

    public function sendToChat(Request $req)
    {
        $text = "$req->username: $req->message";

        $res = Telegram::sendMessage([
            'chat_id' => '-1001857445590',
            'text' => $text
        ]);

        return response()->json([
            'status' => 'success'
        ]);
    }

    public function setWebhook()
    {
        $res = Telegram::setWebhook([
            'url' => 'https://c0ef-84-54-90-10.ngrok-free.app/webhook',
        ]);
        $lastResponse = Telegram::getLastResponse();
        dd($res, $lastResponse);
    }
}






// $res = Telegram::sendMessage([
//     'chat_id' => $update->message->chat->id,
//     'text' => 'Your message: ' . $update->message->text
// ])

// Telegram::sendMessage([
//     'chat_id' => '-1001846990565',
//     'parse_mode' => 'HTML',
//     'text' => "<b> $req->text </b>"
// ]);

// $buttons = [
//     'inline_keyboard' => [
//         [
//             [
//                 'text' => 'allow',
//                 'callback_data' => '1'
//             ]
//         ],
//         [
//             [
//                 'text' => 'deny',
//                 'callback_data' => '0'
//             ]
//         ]
//     ]
// ];
// $res = Telegram::sendMessage([
//     'chat_id' => '-1001846990565',
//     'text' => 'these are buttons',
//     'parse_mode' => 'html',
//     'reply_markup' => json_encode($buttons),
// ]);

// Telegram::editMessageText([
//     'chat_id' => '-1001846990565',
//     'text' => 'these are buttons-2',
//     'parse_mode' => 'html',
//     'reply_markup' => json_encode($buttons),
//     'message_id' => '23'
// ]);

// $res = Telegram::deleteMessage([
//     'chat_id' => $update->message->chat->id,
//     'message_id' => $update->message->message_id,
// ]);

// else if (isset($update->callback_query)) {
//     $chat_id = $update->callback_query->message->chat->id;
//     $text = $update->callback_query->data;
//     $res = Telegram::sendMessage([
//         'chat_id' => $chat_id,
//         'text' => "data: $text"
//     ]);
//     Log::debug($res);
// }

// Conflict: can't use getUpdates method while webhook is active; use deleteWebhook to delete the webhook first
// Route::get('/bot/getupdates', function () {
//     $updates = Telegram::getUpdates();
//     dd($updates);
// });