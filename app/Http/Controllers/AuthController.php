<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        if (Auth::attempt($request->only('email', 'password'))) {

            /** @var User */
            $user = Auth::user();

            $token = $user->createToken('admin', ['student', 'student-detail', 'student-manage']);

            $headers = ["Token" => $token->plainTextToken, "Type" => "Bearer"];
            
            return response()->json('Authorized', Response::HTTP_OK, $headers);
        }

        throw new AuthenticationException('');
    }

    public function logout()
    {
        /** @var User */
        $user = Auth::user();

        $token = $user->currentAccessToken();

        $token->delete();

        return response()->json('Token Revoked', Response::HTTP_OK);
    }
}
