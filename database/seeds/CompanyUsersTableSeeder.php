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
            'company_id' => 1
         ]);

        DB::table('companyusers')->insert([
           'user_id' => 2,
           'company_id' => 4
        ]);

        DB::table('companyusers')->insert([
            'user_id' => 3,
            'company_id' => 6
         ]);

         DB::table('companyusers')->insert([
            'user_id' => 4,
            'company_id' => 8
         ]);

         DB::table('companyusers')->insert([
            'user_id' => 5,
            'company_id' => 10
         ]);

         DB::table('companyusers')->insert([
            'user_id' => 6,
            'company_id' => 2
         ]);
    }
}
