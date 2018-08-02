<?php

use Illuminate\Database\Seeder;

class CompaniesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $entries = factory(App\Company::class, 300)->make();

        foreach ($entries as $entry) {
            repeat:
            try {
                $entry->save();
            } catch (\Illuminate\Database\QueryException $e) {
                $entry = factory(App\Company::class)->make();
                goto repeat;
            }
        }
    }
}
