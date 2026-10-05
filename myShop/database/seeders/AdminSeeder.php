<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::firstOrCreate(
            ['email' => 'admin@test.com'],
            [
                'name' => 'Test Admin',
                'password' => bcrypt('12345'),
                'is_active' => true,
            ]
        );

        $user = User::firstOrCreate(
            ['email' => 'aattritanath@gmail.com'],
            [
                'name' => 'Test User',
                'password' => bcrypt('12345'),
                'is_active' => true,
            ]
        );

        // Optional: Attach a 'user' role if you have one configured in your roles table
        $userRole = Role::where('name', 'admin')->first();
        if ($userRole) {
            $user->roles()->syncWithoutDetaching($userRole);
        }

        $adminRole = Role::where('name', 'admin')->first();
        $admin->roles()->syncWithoutDetaching($adminRole);
    }
}
