<?php

namespace App\Repositories;

use App\Models\Role;
use App\Models\User;
use App\Repositories\Interfaces\RoleUserRepositoryInterface;
use Illuminate\Support\Collection;

class RoleUserRepository extends EloquentGenericRepository implements RoleUserRepositoryInterface
{
    public function __construct(protected Role $role)
    {
        parent::__construct($role);
    }

    public function sync(User $user, array $data): array
    {
        return $user->roles()->sync($data);
    }

    public function related(User $user): Collection
    {
        return Role::whereHas('users', fn($query) => $query->where('users.id', $user->id));
    }

    public function unrelated(User $user): Collection
    {
        return Role::whereDoesntHave('users', fn($query) => $query->where('users.id', $user->id));
    }
}
