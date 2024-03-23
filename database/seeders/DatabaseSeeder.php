<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Event;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Model::unsetEventDispatcher();

        $this->call([
            RoleSeeder::class,
            AbilitySeeder::class,
            AbilityRoleSeeder::class,
            UserSeeder::class,
            StudentSeeder::class,
        ]);

        Model::setEventDispatcher(Event::getFacadeRoot());
    }
}
