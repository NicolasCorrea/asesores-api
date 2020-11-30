<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {}

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(LoginRequest $request)
    {
        $credentials = [
            "username" => $request->get("username"),
            "password" => $request->get("password"),
        ];

        $user = User::whereUsername($credentials["username"])->first();
        if (is_null($user)) {
            return response()->json(['error' => 'Unauthorized'], Response::HTTP_UNAUTHORIZED);
        }
        if ($user->status === "inactive") {
            return response()->json(['error' => 'InactiveUser'], Response::HTTP_UNAUTHORIZED);
        }
        if (Hash::check('plain-text', $user->password)) {
            return response()->json(['error' => 'Unauthorized'], Response::HTTP_UNAUTHORIZED);
        }
        $token = Auth::login($user);

        return response()->json(["token" => $token, "user" => $user,"type" => "bearer"], Response::HTTP_OK);
    }
}
