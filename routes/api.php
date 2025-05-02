<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\JwtMiddleware;


Route::post('login', [AuthController::class, 'login']);

Route::middleware([JwtMiddleware::class])->group(function () {
    Route::get('users/me', [AuthController::class, 'getUser']);
});
//
//// DO: Create dummy cookie and return back to the client
//Route::get('cookie', function () {
//    return response()->json(['message' => 'Cookie set successfully'])
//        ->cookie('accessToken', 'dummy_access_token', 60);
//});
//
//// Do: Collect the cookie from the client and set it as log
//Route::get('collect-cookie', function (Request $request) {
//    $cookie = $request->cookie('accessToken');
//    \Illuminate\Support\Facades\Log::info('Collected cookie from client', ['cookie' => $cookie]);
//    return response()->json(['message' => 'Cookie collected successfully']);
//});
