<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\Interfaces\StudentRepositoryInterface;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\NewAccessToken;

class AuthService
{
    public function __construct(
        private StudentRepositoryInterface $studentRepository
    ) {
    }

    public function loginUser(array $credentials): NewAccessToken
    {
        if (Auth::attempt($credentials)) {
            
            /** @var User */
            $user = Auth::user();

            $name = $user->roles->pluck('name')->implode('-');

            $abilities = $user->abilities()->pluck('name');
            
            return $user->createToken($name, $abilities->toArray());
        }

        throw new AuthenticationException('');
    }

    public function logoutUser(): bool
    {
        /** @var User */
        $user = Auth::user();

        $token = $user->currentAccessToken();

        return $token->delete();
    }
}
