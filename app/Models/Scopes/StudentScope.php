<?php

namespace App\Models\Scopes;

use App\Enums\StatusEnum;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Support\Facades\Gate;

class StudentScope implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     */
    public function apply(Builder $builder, Model $model): void
    {
        if (Gate::denies('listDeleted', $model)) {

            $builder->whereHas(User::class, fn($query) => $query->where('status', StatusEnum::ACTIVE));
        }
    }
}
