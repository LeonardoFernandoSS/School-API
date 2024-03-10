<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory(5)->create()->each(function (User $user) {
            
            $role = Role::where('name', 'admin')->first();

            $user->roles()->sync($role->id);
        });

        User::factory(5)->create()->each(function (User $user) {
            
            $role = Role::where('name', 'professor')->first();

            $user->roles()->sync($role->id);
        });
    }
}
