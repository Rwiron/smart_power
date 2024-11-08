<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    public function run()
    {
        Role::create(['name' => 'superadmin']);
        Role::create(['name' => 'guest']);
        Role::create(['name' => 'admin']);
        Role::create(['name' => 'cashpower_operator']);
        Role::create(['name' => 'customer_service']);
        Role::create(['name' => 'customer']);
        Role::create(['name' => 'technician']);
    }

}