<?php

namespace Database\Seeders;

use App\Enums\RoleEnum;
use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create(['name' => RoleEnum::ADMIN]);
        Role::create(['name' => RoleEnum::TEACHER]);
        Role::create(['name' => RoleEnum::STUDENT]);
    }
}
