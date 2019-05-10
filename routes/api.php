<?php

use Illuminate\Http\Request;

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


Route::resource('clients', 'client\ClientController', ['only' => [ 'index', 'show']]);
Route::resource('client.bill', 'client\ClientBillController', ['except' => [ 'create', 'edit']]);
Route::resource('client.report', 'client\ClientReportController', ['only' => [ 'index', 'show']]);

Route::resource('provider', 'provider\ProviderController', ['only' => [ 'index', 'show']]);
Route::resource('provider.product', 'provider\ProviderProductController', ['except' => [ 'create', 'edit']]);
Route::resource('provider.report', 'provider\ProviderReportController', ['only' => [ 'index', 'show']]);

Route::resource('bills', 'bill\billController', ['except' => [ 'create', 'edit']]);

Route::resource('products', 'product\ProductController', ['only' => [ 'index', 'show']]);
Route::resource('products.report', 'product\ProductReportController', ['only' => [ 'index', 'show']]);
Route::get('productsHasTransactions', 'product\ProductController@getProductsHasTransactions');

Route::resource('user', 'user\UserController', ['except' => [ 'create', 'edit']]);

Route::post('oauth/token', '\Laravel\Passport\Http\Controllers\AccessTokenController@issueToken');
