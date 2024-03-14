<?php

namespace App\Repositories\Interfaces;

interface UserRepositoryInterface extends GenericRepositoryInterface
{
    public function paginate(int $perPage, int $page, array $search = []): iterable;
}
