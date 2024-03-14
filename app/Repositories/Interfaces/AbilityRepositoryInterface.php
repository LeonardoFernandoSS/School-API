<?php

namespace App\Repositories\Interfaces;

interface AbilityRepositoryInterface extends GenericRepositoryInterface
{
    public function paginate(int $perPage, int $page, array $search = []): iterable;
}
