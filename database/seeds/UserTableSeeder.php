<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('secret'),
            'approved' => true,
            'role' => 'Super Admin'
        ]);

        DB::table('users')->insert([
            'name' => 'notAdmin',
            'email' => 'nadmin@gmail.com',
            'password' => bcrypt('secret'),
            'approved' => true,
            'role' => 'Super User'
        ]);

        DB::table('users')->insert([
            'name' => 'Pedro Penduko',
            'email' => 'pedro@gmail.com',
            'password' => bcrypt('secret'),
            'approved' => true,
            'role' => 'Admin'
        ]);

        DB::table('users')->insert([
            'name' => 'Maria Makiling',
            'email' => 'maria@gmail.com',
            'password' => bcrypt('secret'),
            'approved' => true,
            'role' => 'User'
        ]);

        DB::table('users')->insert([
            'name' => 'Juan Luna',
            'email' => 'juan@gmail.com',
            'password' => bcrypt('secret'),
            'approved' => true,
            'role' => 'User'
        ]);

        DB::table('users')->insert([
            'name' => 'Miguel Santos',
            'email' => 'miguel@gmail.com',
            'password' => bcrypt('secret'),
            'approved' => true,
            'role' => 'User'
        ]);


    }
}
