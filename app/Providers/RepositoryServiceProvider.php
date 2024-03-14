<?php

namespace App\Providers;

use App\Repositories\AbilityRepository;
use App\Repositories\AbilityRoleRepository;
use App\Repositories\EloquentGenericRepository;
use App\Repositories\Interfaces\AbilityRepositoryInterface;
use App\Repositories\Interfaces\AbilityRoleRepositoryInterface;
use App\Repositories\Interfaces\GenericRepositoryInterface;
use App\Repositories\Interfaces\RoleRepositoryInterface;
use App\Repositories\Interfaces\RoleUserRepositoryInterface;
use App\Repositories\Interfaces\StudentRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Repositories\RoleRepository;
use App\Repositories\RoleUserRepository;
use App\Repositories\StudentRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
        $this->app->bind(GenericRepositoryInterface::class, EloquentGenericRepository::class);
        $this->app->bind(StudentRepositoryInterface::class, StudentRepository::class);
        $this->app->bind(RoleRepositoryInterface::class, RoleRepository::class);
        $this->app->bind(AbilityRepositoryInterface::class, AbilityRepository::class);
        $this->app->bind(AbilityRoleRepositoryInterface::class, AbilityRoleRepository::class);
        $this->app->bind(RoleUserRepositoryInterface::class, RoleUserRepository::class);
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
    }
}
