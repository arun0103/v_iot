<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Hash;
use Carbon\Carbon;

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
            'created_at' => Carbon::now()

        ]);
        \DB::table('models')->insert([
            'name'=>"DiUse",
            'created_by' => 1
        ]);
        \DB::table('models')->insert([
            'name'=>"DiEntry",
            'created_by' => 1
        ]);

        // \DB::table('resellers')->insert([
        //     'company_name' =>"Voltea Reseller",
        //     'email' =>"support@voltea.com",
        //     'phone'=>123,
        //     'created_by'=>1,
        //     'created_at' =>Carbon::now()
        // ]);
    }
}
