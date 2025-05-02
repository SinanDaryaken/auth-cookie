<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        try {
            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'Invalid credentials'], 401);
            }

            Log::debug('JWT Login - Generated token: ' . $token);

            return response()
                ->json(['message' => 'Login successful'])
                ->cookie('accessToken', $token, 60, '/', 'auth-cookie.home', true, true, true, 'lax');

        } catch (JWTException $e) {
            Log::debug('JWT Login - Error: ' . $e->getMessage());
            return response()->json(['error' => 'Could not create token: ' . $e->getMessage()], 500);
        }
    }

    public function getUser()
    {
        Log::info('It is alive');
        try {
            $user = auth()->user();

            if (!$user) {
                return response()->json(['error' => 'User not found'], 404);
            }

            return response()->json(compact('user'));

        } catch (\Exception $e) {
            return response()->json(['error' => 'Error retrieving user: ' . $e->getMessage()], 400);
        }
    }
}
