<?php

namespace App\Repositories\Interfaces;

use App\Models\User;

interface UserRepositoryInterface extends GenericRepositoryInterface
{
    public function paginate(int $perPage, int $page, array $search = []): iterable;

    public function findByEmail(string $email): ?User;

    public function findByToken(string $token): ?User;
}
