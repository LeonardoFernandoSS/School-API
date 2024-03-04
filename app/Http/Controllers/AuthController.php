<?php

namespace App\Http\Controllers;

use App\Http\Responses\SuccessResponse;
use App\Http\Responses\UnauthenticatedResponse;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        if (Auth::attempt($request->only('email', 'password'))) {

            /** @var User */
            $user = Auth::user();

            $token = $user->createToken('admin', ['student'/*, 'student-detail', 'student-manage'*/]);

            $headers = ["Token" => $token->plainTextToken, "Type" => "Bearer"];
            
            return response()->json('Authorized', Response::HTTP_OK, $headers);
        }

        throw new AccessDeniedHttpException('');
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
