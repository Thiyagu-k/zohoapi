<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ZohoController;

// Route::get('/', function () {
//     return view('welcome');
// });


Route::get('/{pathMatch}', function () {
    return view('welcome');
})->where('pathMatch',".*");


// Route::get('/saleorders', [ZohoController::class, 'index']);
// Route::get('/items', [ZohoController::class, 'getItems']);
// Route::get('/invoice', [ZohoController::class, 'getInvoice']);



// Route::get('/callback', [ZohoController::class, 'handleCallback']);
// Route::get('/api/decode-id-token', [ZohoController::class, 'decodeIdToken']);
