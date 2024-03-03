<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        if (Auth::attempt($request->only('email', 'password'))) {

            /** @var User */
            $user = Auth::user();

            $token = $user->createToken('student', ['student-index']);

            return response('Authorized', 200, ["Token" => $token->plainTextToken, "Type" => "Bearer"]);
        }

        return response('Not Authorized', 403);
    }

    public function logout()
    {
        /** @var User */
        $user = Auth::user();

        $token = $user->currentAccessToken();

        $token->delete;

        return response('Token Revoked', 200);
    }
}
