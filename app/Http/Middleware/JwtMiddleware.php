<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Log;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class JwtMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        Log::info('Raw headers', getallheaders());
        try {
            $token = $request->cookie('accessToken');


            if (!$token) {
                return response()->json(['error' => 'Token not found in cookie'], 401);
            }

            JWTAuth::setToken($token);
            $user = JWTAuth::authenticate();


            if (!$user) {
                return response()->json(['error' => 'User not found'], 401);
            }

        } catch (JWTException $e) {
            return response()->json(['error' => 'Token not valid: ' . $e->getMessage()], 401);
        }

        return $next($request);
    }
}
