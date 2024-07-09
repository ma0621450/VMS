<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        if (DB::table('roles')->count() === 0) {
            $roles = [
                ['role_name' => 'admin'],
                ['role_name' => 'travel_agency'],
                ['role_name' => 'customer'],
            ];
            DB::table('roles')->insert($roles);
        }

        if (DB::table('users')->count() === 0) {
            $users = [
                [
                    'username' => 'admin',
                    'email' => 'admin@gmail.com',
                    'password' => bcrypt('admin123'),
                    'phone_number' => '0123456789',
                    'role_id' => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                    'deleted_at' => null,
                ],
            ];
            DB::table('users')->insert($users);
        }

        if (DB::table('services')->count() === 0) {
            $services = [
                ['service' => 'Airport Transfer'],
                ['service' => 'Tour Guide'],
                ['service' => 'Accommodation'],
                ['service' => 'Car Rental'],
                ['service' => 'Travel Insurance'],
                ['service' => 'Cruise Booking'],
                ['service' => 'Sightseeing Tours'],
                ['service' => 'Adventure Activities'],
                ['service' => 'Spa & Wellness'],
                ['service' => 'Restaurant Reservations'],
            ];
            DB::table('services')->insert($services);
        }

        if (DB::table('destinations')->count() === 0) {
            $destinations = [
                ['destination' => 'Paris, France'],
                ['destination' => 'New York City, USA'],
                ['destination' => 'Tokyo, Japan'],
                ['destination' => 'Rome, Italy'],
                ['destination' => 'Sydney, Australia'],
                ['destination' => 'Cape Town, South Africa'],
                ['destination' => 'Rio de Janeiro, Brazil'],
                ['destination' => 'Dubai, UAE'],
                ['destination' => 'Barcelona, Spain'],
                ['destination' => 'Bali, Indonesia'],
            ];
            DB::table('destinations')->insert($destinations);
        }
    }
}
