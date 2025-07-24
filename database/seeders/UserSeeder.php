<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create admin role if it doesn't exist
        // $adminRole = Role::firstOrCreate(['name' => 'admin']);

        // // Create user
        // $user = User::firstOrCreate(
        //     ['email' => 'admin@brndwrx.com'],
        //     [
        //         'name' => 'Admin',
        //         'phone' => '12345678',
        //         'department_id' => 0,
        //         'bussiness_unit_id' => 0,
        //         'country_id' => 0,
        //         'password' => Hash::make('password'),
        //     ]
        // );

        // // Assign or sync admin role
        // $user->syncRoles([$adminRole]);
        $user = User::updateOrCreate([
            'email' => 'admin@brndwrx.com',
        ], [
            'name' => 'Admin',
            'password' => Hash::make('password'),
        ]);

        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $user->syncRoles([$adminRole]);
    }
}