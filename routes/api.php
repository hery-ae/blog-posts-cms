<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Post;

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

Route::middleware('auth:sanctum')->group( function() {
    Route::get('/posts', [Post::class, 'index']);
    Route::get('/{category}/posts', [Post::class, 'index']);
    Route::get('/{category}/{post_name}', [Post::class, 'detail']);
});
