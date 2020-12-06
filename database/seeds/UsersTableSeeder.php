<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Ray',
            'email' => 'rayxi215@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('rayxi215'),
            'is_superadmin' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
