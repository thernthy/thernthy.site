<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LiveChatMessage;
use GuzzleHttp\Client;

class LiveChatController extends Controller
{
    public function sendMessage(Request $request)
    {
        $request->validate([
            'message' => 'required|string',
        ]);

        $session_id = session()->getId();
        $message = $request->message;

        // Store in database
        $chatMessage = LiveChatMessage::create([
            'session_id' => $session_id,
            'message' => $message,
            'is_from_user' => true,
        ]);

        // Send message to Telegram
        $this->sendToTelegram($session_id, $message);

        return response()->json(['success' => true]);
    }

    private function sendToTelegram($session_id, $message)
    {
        $token = env('TELEGRAM_BOT_TOKEN');
        $chat_id = env('TELEGRAM_CHAT_ID'); // Your Telegram user or group chat ID

        $text = "New Chat Message:\nSession: $session_id\nMessage: $message";

        $client = new Client();
        $client->post("https://api.telegram.org/bot{$token}/sendMessage", [
            'json' => [
                'chat_id' => $chat_id,
                'text' => $text,
            ]
        ]);
    }

    public function getMessages()
    {
        $session_id = session()->getId();
        $messages = LiveChatMessage::where('session_id', $session_id)->get();
        return response()->json($messages);
    }
}
