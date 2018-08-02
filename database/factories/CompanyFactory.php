<?php

use Faker\Generator as Faker;

$factory->define(App\Company::class, function (Faker $faker) {
    return [
        'company_name' => $faker->company,
        'contact_number' => $faker->phoneNumber,
        'email' => $faker->unique()->safeEmail,
        'address' => $faker->unique()->address
    ];
});
