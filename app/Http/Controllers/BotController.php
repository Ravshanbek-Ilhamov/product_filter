<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class BotController extends Controller
{
    public function index()
    {
        return view('sendMessage');
    }

    public function sendMessageToBot(Request $request)
    {
        // dd($request->all());

        // $request->validate([
        //     'message' => 'required|string|max:255',
        //     'file' => 'required|mimes:jpg,jpeg,png,gif,mp4,mov,webm|max:10048',
        // ]);

        $filePath = $request->file('file')->store('uploads', 'public');
        // dd($filePath);
        // Use only the token, not the full API URL
        $token = '7590083906:AAEYdfg73-1HQQPYOOU7tfWqckQQX46Z5b4';
        $chatId = '5648765646';

        $fileMimeType = $request->file('file')->getMimeType();
        $method = str_contains($fileMimeType, 'image') ? 'sendPhoto' : 'sendVideo';
        $inputType = $method === 'sendPhoto' ? 'photo' : 'video';

        $response = Http::attach(
            $inputType,
            file_get_contents(storage_path("app/public/$filePath")),
            basename($filePath)
        )->post("https://api.telegram.org/bot$token/$method", [
            'chat_id' => $chatId,
            'caption' => $request->input('message'),
            'parse_mode' => 'HTML',
        ]);

        if ($response->successful()) {
            return back()->with('success', ucfirst($method) . ' sent successfully!');
        }

        return back()->with('error', 'Failed to send ' . $method . '. Please try again.');

    }

    
}
