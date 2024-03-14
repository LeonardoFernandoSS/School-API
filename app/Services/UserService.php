<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class UserService
{
    public function __construct(
        private UserRepositoryInterface $userRepository
    ) {
    }

    public function getPaginate($perPage, $page, array $search): LengthAwarePaginator
    {
        return $this->userRepository->paginate($perPage, $page, $search);
    }

    public function createUser(array $data): User
    {
        $data['password'] = Hash::make('password');
        $data['remember_token'] = Str::random(10);

        return $this->userRepository->create($data);
    }

    public function findUser(string $id): ?User
    {
        $user = $this->userRepository->find($id);

        if (is_null($user)) throw new NotFoundHttpException('');

        return $user;
    }

    public function updateUser(User $user, array $data): User
    {
        return $this->userRepository->update($user, $data);
    }

    public function deleteUser(User $user): User
    {
        return $this->userRepository->delete($user);
    }
}
