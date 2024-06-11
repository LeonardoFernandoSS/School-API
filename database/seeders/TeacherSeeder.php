<?php

namespace Database\Seeders;

use App\Enums\RoleEnum;
use App\Models\Role;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Database\Seeder;

class TeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory(2)->create()->each(function (User $user) {
            
            Teacher::factory()->create(['user_id' => $user->id]);

            $role = Role::where('name', RoleEnum::STUDENT)->first();
            
            $user->roles()->sync($role->id);
        });
    }
}
