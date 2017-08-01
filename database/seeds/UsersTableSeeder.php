<?php

use Illuminate\Database\Seeder;

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
            'username' => "doubldragon",
            'email' => "brandon.spencer@gmail.com",
            'password' => bcrypt("siegetank"),
            'isAdmin' => true,
            ]);

        DB::table('users')->insert([
            'username' => "bigyen",
            'email' => "bigyen@gmail.com",
            'password' => bcrypt("bigyen"),
            'isAdmin' => false,
            ]);
    }
}
