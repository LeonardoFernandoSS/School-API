<?php

namespace App\Repositories\Interfaces;

interface RoleRepositoryInterface extends GenericRepositoryInterface
{
    public function paginate(int $perPage, int $page, array $search = []): iterable;
}
