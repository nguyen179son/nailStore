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
            'user_name' => 'chutruyen',
//            'email' => 'chutruyendeptrai@gmail.com',
            'password' => bcrypt('truyendeptraihihi'),
        ]);
    }
}
