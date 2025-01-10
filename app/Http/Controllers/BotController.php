<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class BotController extends Controller
{
    public function index()
    {
        return view('sendMessage');
    }

    public function sendMessageToBot(string $message, int $chat_id)
    {
        $token = env('TELEGRAM_BOT_TOKEN'); // Use environment variable
        $response = Http::post("https://api.telegram.org/bot$token/sendMessage", [
            'chat_id' => $chat_id,
            'text' => $message,
            'parse_mode' => 'HTML',

        ]);

        if ($response->successful()) {
            return response()->json(['status' => 'success', 'message' => 'Message sent successfully.']);
        } else {
            Log::error('Telegram API error: ' . $response->body());
            return response()->json(['status' => 'error', 'message' => 'Failed to send message.'], 500);
        }
    }

    public function getBotResponse(Request $request)
    {
        try {
            $data = $request->all();

            if (!isset($data['message']['text'], $data['message']['chat']['id'])) {
                return response()->json(['status' => 'error', 'message' => 'Invalid Telegram data'], 400);
            }

            $text = $data['message']['text'];
            $chat_id = $data['message']['chat']['id'];

            $this->sendMessageToBot($text, $chat_id);
            Log::info('Received Telegram message: ' . $text . ' from chat ID: ' . $chat_id);

            return response()->json(['status' => 'success'], 200);
        } catch (\Exception $e) {
            Log::error('Telegram Webhook error: ' . $e->getMessage());
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }
}

