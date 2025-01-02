<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use OpenAI\client;
 function chat(Request $request)
{
    $client = Client::fromApiKey(env('OPENAI_API_KEY'));

    $response = $client->chat()->create([
        'model' => 'gpt-4',
        'messages' => [
            ['role' => 'system', 'content' => 'You are a helpful assistant.'],
            ['role' => 'user', 'content' => $request->input('message')],
        ],
    ]);

    return response()->json($response);
}
