<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class JwtVerify
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        try {
            $user = Auth::user();
            $request->merge([
                'user' => $user,
            ]);
            $payload = Auth::payload();
        } catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
            return response()->json(['status' => 'Token is Invalid'], Response::HTTP_UNAUTHORIZED);
        } catch (\Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
            return response()->json(['status' => 'Token is Expired'], Response::HTTP_UNAUTHORIZED);
        } catch (\Tymon\JWTAuth\Exceptions\JWTException $e) {
            return response()->json(['status' => 'Token is empty'], Response::HTTP_BAD_REQUEST);
        }

        $token = Auth::refresh(false);
        $request->merge([
            'token' => $token,
        ]);
        return $next($request);
    }
}
