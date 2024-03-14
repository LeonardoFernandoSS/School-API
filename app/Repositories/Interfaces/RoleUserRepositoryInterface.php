<?php

namespace App\Repositories\Interfaces;

use App\Models\User;
use Illuminate\Support\Collection;

interface RoleUserRepositoryInterface extends GenericRepositoryInterface
{
    public function sync(User $user, array $data): array;

    public function related(User $user): Collection;
    
    public function unrelated(User $user): Collection;
}
