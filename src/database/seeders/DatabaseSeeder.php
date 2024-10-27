<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Hash;
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
        //     'name' => 'Ngô Hồng Toại',
        //     'email' => 'nht2024@gmail.com',
        //     'password' => Hash::make('User@123456'),
        //     'phone' => '0987654321',
        //     'gender' => 1,
        //     'birthday' => '2003-01-02',
        //     'address' => 'Kiên Giang',
        //     'user_catalogue_id' => '1',
        // ]);

        // $this->call([
            // UserSeeder::class,
        //     CustomerSeeder::class,
        // ]);
    }
}
