<?php

use App\Http\Controllers\WishlistContentsController;
use App\Http\Controllers\WishlistController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

/*
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
*/

Route::middleware('api')->resource('wishlist', WishlistController::class);
Route::middleware('api')->resource('wishlist_contents', WishlistContentsController::class);

//Route::middleware('api')->get('/wishlist', [WishlistController::class, 'index']);
//Route::middleware('api')->post('/wishlist', [WishlistController::class, 'index']);

