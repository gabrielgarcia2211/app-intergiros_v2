<?php

namespace Database\Seeders\Users;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminUser = User::create([
            'name' => 'Admin User',
            'email' => 'gabriel@gmail.com',
            'password' => bcrypt('password'), // Cambia 'password' por la contraseña deseada
        ]);

        $clientUser = User::create([
            'name' => 'Client User',
            'email' => 'client@example.com',
            'password' => bcrypt('password'), // Cambia 'password' por la contraseña deseada
        ]);

        $adminRole = Role::where('name', 'admin')->first();
        $clientRole = Role::where('name', 'client')->first();

        $adminUser->assignRole($adminRole);
        $clientUser->assignRole($clientRole);
    }
}
