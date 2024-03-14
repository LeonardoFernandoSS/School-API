<?php

namespace App\Services;

use App\Models\Role;
use App\Repositories\Interfaces\AbilityRoleRepositoryInterface;
use Illuminate\Support\Collection;

class AbilityRoleService
{
    public function __construct(
        private AbilityRoleRepositoryInterface $abilityroleRepository
    ) {
    }

    public function syncAbilityRole(Role $role, array $data): array
    {
        return $this->abilityroleRepository->sync($role, $data);
    }

    public function relatedAbilityRole(Role $role): Collection
    {
        return $this->abilityroleRepository->related($role);
    }

    public function unrelatedAbilityRole(Role $role): Collection
    {
        return $this->abilityroleRepository->unrelated($role);
    }
}
