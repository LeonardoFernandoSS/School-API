<?php

namespace Database\Seeders;

use App\Enums\RoleEnum;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory(1)->create([
            'email' => 'admin@email',
            'password' => Hash::make('password'),
        ])->each(function (User $user) {
            
            $role = Role::where('name', RoleEnum::ADMIN)->first();

            $user->roles()->sync($role->id);
        });

        User::factory(5)->create()->each(function (User $user) {
            
            $role = Role::where('name', RoleEnum::TEACHER)->first();

            $user->roles()->sync($role->id);
        });
    }
}
