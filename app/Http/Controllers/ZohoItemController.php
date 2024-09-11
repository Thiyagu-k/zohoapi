<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Helpers\TokenManager;

class ZohoItemController extends Controller
{
    public function getItems()
    {
        $client = new Client();
        $accessToken = TokenManager::getAccessToken();

        $response = $client->get(env('ZOHO_INVENTORY_API_URL') . 'items', [
            'headers' => [
                'Authorization' => 'Zoho-oauthtoken ' . $accessToken,
                'Content-Type' => 'application/json'
            ]
        ]);

        $items = json_decode($response->getBody()->getContents(), true);

        return response()->json($items);
    }
}
