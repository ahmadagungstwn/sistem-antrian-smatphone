<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $owerRole = Role::create(['name' => 'owner']);

        $buyerRole = Role::create(['name' => 'buyer']);

        $owner = User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('password'),
        ]);

        $buyer = User::create([
            'name' => 'alexsander',
            'email' => 'buyer@gmail.com',
            'password' => bcrypt('password'),
        ]);

        $owner->assignRole($owerRole);
        $buyer->assignRole($buyerRole);
    }
}
