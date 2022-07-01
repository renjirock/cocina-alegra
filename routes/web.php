<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Kitchen;
use App\Http\Controllers\Bodega;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('index');
})->name('index');

Route::get('orders', 'App\Http\Controllers\Kitchen@get_orders')
    ->name('orders');

Route::post('/kitchen/create_order', 'App\Http\Controllers\Kitchen@create_order')
    ->name('kitchen.create_order');

Route::get('ingredients', 'App\Http\Controllers\Bodega@get_ingredients')
    ->name('ingredients');

Route::prefix('api/1.0')->group(function () {
    Route::post('/kitchen/create_prescription', 'App\Http\Controllers\Kitchen@create_prescription')
        ->name('api.kitchen.create_prescription');

    Route::post('/bodega/create_ingredient', 'App\Http\Controllers\Bodega@create_ingredient')
    ->name('api.bodega.create_ingredient');
});
