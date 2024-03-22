<?php

namespace App\Services;

use App\Mail\SendRememberPassword;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class PasswordService
{
    public function __construct(
        private UserRepositoryInterface $userRepository
    ) {
    }

    public function rememberPassword(string $email): void
    {
        $user = $this->userRepository->findByEmail($email);

        if (empty($user)) throw new NotFoundHttpException();

        try {
            Mail::to($email)->send(new SendRememberPassword($user));
        } catch (\Throwable $th) {
            error_log($th->getMessage());
        }
    }

    public function resetPassword(string $token, string $password): void
    {
        $user = $this->userRepository->findByToken($token);

        if (empty($user)) throw new NotFoundHttpException();

        $data['password'] = Hash::make($password);
        $data['token'] = Str::random(4);

        $this->userRepository->update($user, $data);
    }
}
