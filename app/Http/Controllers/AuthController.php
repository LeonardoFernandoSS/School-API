<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        if (Auth::attempt($request->only('email', 'password'))) {

            $token = $request->user()->createToken('student', ['student-index']);

            return response('Authorized', 200, ['token' => $token]);
        }

        return response('Not Authorized', 403);
    }

    public function logout()
    {
    }
}
