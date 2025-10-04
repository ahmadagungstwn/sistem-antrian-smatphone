<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Service;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call(RolePermissionSeeder::class);

        Service::create([
            'queue_number' => 1,
            'customer_name' => 'John Doe',
            'phone_type' => 'Samsung',
            'damage_description' => 'Screen broken',
            'repair_costs' => 100000,
            'notes' => null,
            'attachment' => null,
            'user_id' => 1,
            'status_confirmation' => 'Menunggu Konfirmasi',
            'rejection_notes' => null,
            'status_repair' => 'Menunggu Antrian',
        ]);

        Service::create([
            'queue_number' => 2,
            'customer_name' => 'alexander',
            'phone_type' => 'xiaomi',
            'damage_description' => 'LCD broken',
            'repair_costs' => 250000,
            'notes' => null,
            'attachment' => null,
            'user_id' => 2,
            'status_confirmation' => 'Menunggu Konfirmasi',
            'rejection_notes' => null,
            'status_repair' => 'Menunggu Antrian',
        ]);
    }
}
