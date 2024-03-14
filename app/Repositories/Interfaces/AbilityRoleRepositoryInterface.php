<?php

namespace App\Repositories\Interfaces;

use App\Models\Role;
use Illuminate\Support\Collection;

interface AbilityRoleRepositoryInterface extends GenericRepositoryInterface
{
    public function sync(Role $role, array $data): array;

    public function related(Role $role): Collection;
    
    public function unrelated(Role $role): Collection;
}
