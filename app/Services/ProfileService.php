<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Facades\Auth;

class ProfileService
{
    public function __construct(
        private UserRepositoryInterface $userRepository
    ) {
    }

    public function findProfile(): User
    {
        $user = Auth::user();

        if (empty($user)) throw new AuthenticationException('');

        return $user;
    }

    public function updateProfile(User $user, array $data): User
    {
        return $this->userRepository->update($user, $data);
    }

    public function updatePassword(User $user, string $password): User
    {
        $data['password'] = bcrypt($password);

        return $this->userRepository->update($user, $data);
    }

    public function deleteProfile(User $user): User
    {
        return $this->userRepository->delete($user);
    }
}
