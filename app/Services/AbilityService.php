<?php

namespace App\Services;

use App\Models\Ability;
use App\Repositories\Interfaces\AbilityRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

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

    public function findAbility(string $id): ?Ability
    {
        $ability = $this->abilityRepository->find($id);

        if (is_null($ability)) throw new NotFoundHttpException('');

        return $ability;
    }
}
