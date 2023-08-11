<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        $roleSales = Role::where('name', 'Sales')->first();
        $roleManager = Role::where('name', 'Manager')->first();
        $roleCustomer = Role::where('name', 'Customer')->first();

        User::create([
            'name' => 'John Doe',
            'role_id' => $roleSales->id,
            'email' => 'john@example.com',
            'phone' => '1234567890',
            'gender' => 'Male',
        ]);

        User::create([
            'name' => 'Jane Smith',
            'role_id' => $roleManager->id,
            'email' => 'jane@example.com',
            'phone' => '9876543210',
            'gender' => 'Female',
        ]);

        User::create([
            'name' => 'Alice Johnson',
            'role_id' => $roleCustomer->id,
            'email' => 'alice@example.com',
            'phone' => '5555555555',
            'gender' => 'Female',
        ]);
    }
}
