<?php

namespace App\Providers;

use App\Repositories\EloquentGenericRepository;
use App\Repositories\Interfaces\GenericRepositoryInterface;
use App\Repositories\Interfaces\StudentRepositoryInterface;
use App\Repositories\StudentRepository;
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
    }
}
