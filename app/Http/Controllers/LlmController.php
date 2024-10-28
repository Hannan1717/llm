<?php

namespace App\Http\Controllers;

use GeminiAPI\Client as GeminiAPIClient;
use GeminiAPI\Resources\Parts\TextPart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use ParsedownExtra;

class LlmController extends Controller
{

    public function index()
    {
        return view('llm');
    }


    public function generateResponse(Request $request)
    {

        $prompt = $request->input('prompt');
        $client = new GeminiAPIClient(env('GEMINI_API_KEY'));

        // Mendapatkan respons dari API Gemini
        $response = $client->geminiPro()->generateContent(
            new TextPart($prompt)
        );

        // Log::info(json_encode($response->text(), JSON_PRETTY_PRINT));
        // Mengubah teks respons menjadi HTML
        $parsedown = new ParsedownExtra();
        $formattedResponse = $parsedown->text($response->text());

        return response()->json(['response' => $formattedResponse]);
    }
}
