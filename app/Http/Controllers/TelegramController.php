<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LiveChatMessage;

class TelegramController extends Controller
{
    public function handleWebhook(Request $request)
    {
        $message = $request->input('message');
        if (!$message || !isset($message['text'])) {
            return response()->json(['error' => 'Invalid message'], 400);
        }

        $text = $message['text'];
        $reply_to_text = explode("\n", $text, 3);
        
        if (count($reply_to_text) < 3) {
            return response()->json(['error' => 'Invalid reply format'], 400);
        }

        $session_id = trim(str_replace('Session: ', '', $reply_to_text[1]));
        $reply_message = $reply_to_text[2];

        // Store the reply in database
        LiveChatMessage::create([
            'session_id' => $session_id,
            'message' => $reply_message,
            'is_from_user' => false,
            'is_replied' => true,
        ]);

        return response()->json(['success' => true]);
    }
}
