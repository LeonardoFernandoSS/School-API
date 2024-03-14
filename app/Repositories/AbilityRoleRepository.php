<?php

namespace App\Repositories;

use App\Models\Ability;
use App\Models\Role;
use App\Repositories\Interfaces\AbilityRoleRepositoryInterface;
use Illuminate\Support\Collection;

class AbilityRoleRepository extends EloquentGenericRepository implements AbilityRoleRepositoryInterface
{
    public function __construct(protected Ability $ability)
    {
        parent::__construct($ability);
    }

    public function sync(Role $role, array $data): array
    {
        return $role->abilities()->sync($data);
    }

    public function related(Role $role): Collection
    {
        return Ability::whereHas('roles', fn($query) => $query->where('roles.id', $role->id));
    }

    public function unrelated(Role $role): Collection
    {
        return Ability::whereDoesntHave('roles', fn($query) => $query->where('roles.id', $role->id));
    }
}
