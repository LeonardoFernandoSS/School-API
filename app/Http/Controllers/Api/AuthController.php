<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\AuthService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AuthController extends Controller
{
    public function __construct(private AuthService $authService)
    {
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        $token = $this->authService->loginUser($credentials);

        $headers = ["Token" => $token->plainTextToken, "Type" => "Bearer"];

        return response()->json('Authorized', Response::HTTP_OK, $headers);
    }

    public function logout()
    {
        $this->authService->logoutUser();

        return response()->json('Token Revoked', Response::HTTP_OK);
    }
}
