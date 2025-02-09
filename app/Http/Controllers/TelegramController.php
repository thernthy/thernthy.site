<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class TelegramController extends Controller
{
    public function webhook(Request $request)
    {
        $update = $request->all();
    
        if (isset($update['message'])) {
            $chatId = $update['message']['chat']['id'];
            $messageText = $update['message']['text'];
    
            TelegramMessage::create([
                'chat_id' => $chatId,
                'message' => $messageText,
            ]);
    
            $this->sendMessage($chatId, "Received: " . $messageText);
        }
    
        return response()->json(['status' => 'ok']);
    }

    public function sendMessage($chatId, $message)
    {
        $token = env('TELEGRAM_BOT_TOKEN');
        $url = "https://api.telegram.org/bot{$token}/sendMessage";

        Http::post($url, [
            'chat_id' => $chatId,
            'text' => $message,
        ]);
    }
}
