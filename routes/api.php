<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Currency\Version1\DigitalCurrencyController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


$apiGroup = [
    'namespace' => 'App\Http\Controllers\Auth',
    'as' => 'api::',
];


Route::post('currency/digital/volume/amount', 'App\Http\Controllers\Api\Currency\Version1\DigitalCurrencyController@volumeOfCurrenciesByAmount')
    ->name('api.currency.digital.volume.amount')
;
