<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ZohoController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/callback', [ZohoController::class, 'callback']);

Route::post('/refresh-token', [ZohoController::class, 'refreshAccessToken']);

Route::get('/salesorders', [ZohoController::class, 'index']);

Route::get('/salesorders/{id}', [ZohoController::class, 'show']);

Route::put('/salesorders/{id}', [ZohoController::class, 'update']);

Route::delete('/salesorders/{id}', [ZohoController::class, 'delete']);

Route::get('/items', [ZohoController::class, 'getItems']);

Route::get('/contacts', [ZohoController::class, 'zohoContacts']);
