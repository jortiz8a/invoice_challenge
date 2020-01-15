<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Client;
use Faker\Generator as Faker;

$factory->define(Client::class, function (Faker $faker) {
    return [
        'first_name' => $faker->firstName,
        'last_name'=> $faker->lastName,
        'id_type'=> $faker->randomLetter,
        'id_number'=> $faker->ean8,
        'email'=> $faker->email,
        'address'=> $faker->streetAddress,
        'phone'=> $faker->randomNumber(10),
        'country'=> $faker->country,
        'city'=> $faker->city,


    ];
});
?>
