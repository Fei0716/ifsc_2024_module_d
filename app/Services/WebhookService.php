<?php

namespace App\Services;

use Exception;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class WebhookService
{
    public static function send(string $url, array $data)
    {
        // Send a POST request to the webhook URL with the data
        try {
            $response = Http::post($url, ['data' => $data]);
            if ($response->successful()) {
                return true;
            }

            Log::error('Webhook failed with status code: ' . $response->body());
        } catch (Exception $e) {
            Log::error('Failed to send webhook: ' . $e->getMessage());
        }
    }
}
