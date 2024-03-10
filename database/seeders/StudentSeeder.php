<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\Student;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory(10)->create()->each(function (User $user) {
            
            Student::factory()->create(['user_id' => $user->id]);

            $role = Role::where('name', 'student')->first();
            
            $user->roles()->sync($role->id);
        });
    }
}
