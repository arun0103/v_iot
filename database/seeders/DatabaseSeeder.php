<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        \DB::table('users')->insert([
            'name' => "Arun Amatya",
            'email' => 'arun.amatya12345@gmail.com',
            'password' => Hash::make('123456789'),
            'role'  => 'S',
            'created_by' => 1,

        ]);
    }
}
