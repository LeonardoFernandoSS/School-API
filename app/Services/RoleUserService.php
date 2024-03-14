<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\Interfaces\RoleUserRepositoryInterface;
use Illuminate\Support\Collection;

class RoleUserService
{
    public function __construct(
        private RoleUserRepositoryInterface $abilityRoleRepository
    ) {
    }

    public function syncRoleUser(User $user, array $data): array
    {
        return $this->abilityRoleRepository->sync($user, $data);
    }

    public function relatedRoleUser(User $user): Collection
    {
        return $this->abilityRoleRepository->related($user);
    }

    public function unrelatedRoleUser(User $user): Collection
    {
        return $this->abilityRoleRepository->unrelated($user);
    }
}
