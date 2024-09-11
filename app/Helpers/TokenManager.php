<?php

namespace App\Helpers;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class TokenManager
{
    public static function getAccessToken()
    {
        // Check if token is cached
        $accessToken = Cache::get('zoho_access_token');

        if ($accessToken) {
            return $accessToken;
        }

        // Get a new access token
        try {
            $client = new Client();
            $response = $client->post('https://accounts.zoho.com/oauth/v2/token', [
                'form_params' => [
                    'refresh_token' => env('ZOHO_REFRESH_TOKEN'),
                    'client_id' => env('ZOHO_CLIENT_ID'),
                    'client_secret' => env('ZOHO_CLIENT_SECRET'),
                    'grant_type' => 'refresh_token'
                ]
            ]);

            $body = json_decode($response->getBody(), true);
            $accessToken = $body['access_token'];

            // Cache the access token for 1 hour
            Cache::put('zoho_access_token', $accessToken, now()->addHour());

            return $accessToken;
        } catch (\Exception $e) {
            Log::error('Error obtaining Zoho access token: ' . $e->getMessage());
            throw new \Exception('Error obtaining access token.');
        }
    }
}
