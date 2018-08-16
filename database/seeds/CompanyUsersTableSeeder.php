<?php

use Illuminate\Database\Seeder;

class CompanyUsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('companyusers')->insert([
            'user_id' => 1,
            'company_id' => null
         ]);
    }
}
