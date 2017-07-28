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
        	'role_id' => 1,
        	]);
    }
}
