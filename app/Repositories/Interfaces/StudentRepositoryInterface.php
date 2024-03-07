<?php

namespace App\Repositories\Interfaces;

interface StudentRepositoryInterface extends GenericRepositoryInterface
{
    public function paginate(int $perPage, int $page, array $search = []): iterable;
}
