<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = \App\User::create(
            [
                'name' => 'Raditya Wahyu Sasono',
                'username' => 'Administrator',
                'email' => 'radityaw@gmail.com',
                'password' => Hash::make('12345'), // password
                'role' => 'superuser'
            ]
        );

    }
}
