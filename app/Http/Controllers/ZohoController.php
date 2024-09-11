<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Helpers\TokenManager;
use Illuminate\Support\Facades\Log;

class ZohoController extends Controller
{
    // Fetch all sales orders
    public function index()
    {
        $client = new Client();
        $accessToken = TokenManager::getAccessToken();

        try {
            $response = $client->get(env('ZOHO_INVENTORY_API_URL') . 'salesorders', [
                'headers' => [
                    'Authorization' => 'Zoho-oauthtoken ' . $accessToken,
                    'Content-Type' => 'application/json'
                ]
            ]);

            $salesOrders = json_decode($response->getBody()->getContents(), true);

            return response()->json($salesOrders);
        } catch (\Exception $e) {
            Log::error('Error fetching sales orders: ' . $e->getMessage());
            return response()->json(['error' => 'Error fetching sales orders'], 500);
        }
    }

    public function show($id)
    {
        $client = new Client();
        $accessToken = TokenManager::getAccessToken();

        try {
            $response = $client->get(env('ZOHO_INVENTORY_API_URL') . 'salesorders/' . $id, [
                'headers' => [
                    'Authorization' => 'Zoho-oauthtoken ' . $accessToken,
                    'Content-Type' => 'application/json'
                ]
            ]);

            $order = json_decode($response->getBody()->getContents(), true);

            return response()->json(['order' => $order]);
        } catch (\Exception $e) {
            Log::error('Error fetching sales order details: ' . $e->getMessage());
            return response()->json(['error' => 'Error fetching sales order details'], 500);
        }
    }

    public function update(Request $request, $id)
    {
        $client = new Client();
        $accessToken = TokenManager::getAccessToken();

        $validatedData = $request->validate([
            'date' => 'required|date',
            'shipment_date' => 'required|date',
            'line_items' => 'required|array',
            'line_items.*.item_id' => 'required|string|max:50',
            'line_items.*.rate' => 'required|numeric',
            'line_items.*.quantity' => 'required|numeric',
        ]);

        // dd($validatedData);

        try {
            // Prepare data for the API request
            $orderData = [
                'shipment_date' => $validatedData['shipment_date'],
                'line_items' => $validatedData['line_items'],
            ];

            // Send the update request to Zoho Inventory API
            $response = $client->put(env('ZOHO_INVENTORY_API_URL') . 'salesorders/' . $id, [
                'headers' => [
                    'Authorization' => 'Zoho-oauthtoken ' . $accessToken,
                    'Content-Type' => 'application/json'
                ],
                'json' => $orderData
            ]);

            $updatedOrder = json_decode($response->getBody()->getContents(), true);

            return response()->json(['message' => 'Sales order updated successfully!', 'order' => $updatedOrder]);
        } catch (\Exception $e) {
            Log::error('Error updating sales order: ' . $e->getMessage());
            return response()->json(['error' => 'Error updating sales order'], 500);
        }
    }

    public function delete($id)
    {
        $client = new Client();
        $accessToken = TokenManager::getAccessToken();

        try {
            $response = $client->delete(env('ZOHO_INVENTORY_API_URL') . 'salesorders/' . $id, [
                'headers' => [
                    'Authorization' => 'Zoho-oauthtoken ' . $accessToken,
                    'Content-Type' => 'application/json'
                ]
            ]);

            return response()->json(['message' => 'Order deleted successfully']);
        } catch (\Exception $e) {
            Log::error('Error deleting sales order: ' . $e->getMessage());
            return response()->json(['error' => 'Error deleting sales order'], 500);
        }
    }

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

    public function zohoContacts()
    {
        $client = new Client();
        $accessToken = TokenManager::getAccessToken();

        $response = $client->get(env('ZOHO_INVENTORY_API_URL') . 'contacts', [
            'headers' => [
                'Authorization' => 'Zoho-oauthtoken ' . $accessToken,
                'Content-Type' => 'application/json'
            ]
        ]);

        $contacts = json_decode($response->getBody()->getContents(), true);

        return response()->json($contacts);
    }
}
