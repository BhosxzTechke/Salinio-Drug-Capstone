<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class AdminAIAssistantService
{
    public function ask($message, $context = '')
    {
        // First, just check if API key is loaded
        $apiKey = config('services.openai.key');

        if (!$apiKey) {
            return 'API key not found!';
        }

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $apiKey,
            'Content-Type'  => 'application/json',
        ])->post('https://api.openai.com/v1/chat/completions', [
            'model' => 'gpt-4o-mini',  // cheap and fast for testing
            'messages' => [
                [
                    'role' => 'system',
                    'content' => 'You are an AI assistant for a pharmacy admin system. Only answer inventory, sales, expiry, and operational questions. Do NOT give medical advice.'
                ],
                [
                    'role' => 'user',
                    'content' => $context . "\n\nAdmin Question: " . $message
                ],
            ],
        ]);

        if ($response->failed()) {
            return 'API request failed: ' . $response->body();
        }

        $data = $response->json();

        return $data['choices'][0]['message']['content'] ?? 'No response from AI.';
    }

    
}
