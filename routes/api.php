<?php

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('image-to-base64', function (Request $request) {
    $inputImage = $request->image;
    $base64 = base64_encode(file_get_contents($inputImage));
    return ['status' => true, 'predict' => "somthing else", 'image' => $base64];
});
