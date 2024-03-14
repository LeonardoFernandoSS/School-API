<?php

namespace App\Services;

use App\Models\Ability;
use App\Repositories\Interfaces\AbilityRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;

class AbilityService
{
    public function __construct(
        private AbilityRepositoryInterface $abilityRepository
    ) {
    }

    public function getPaginate($perPage, $page, array $search): LengthAwarePaginator
    {
        return $this->abilityRepository->paginate($perPage, $page, $search);
    }
}
