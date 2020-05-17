<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Contact;
use Faker\Generator as Faker;

$factory->define(Contact::class, function (Faker $faker) {
    return [
        'team_id' => $faker->numberBetween($min = 10000, $max = 99999),
        'unsubscribed_status' => $faker->randomElement(['none', 'suscribed', 'canceled']),
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'phone' => $faker->phoneNumber,
        'email' => $faker->email,
        'sticky_phone_number_id' => $faker->numberBetween($min = 10000, $max = 99999),
        'twitter_id' => $faker->domainWord,
        'fb_messenger_id' => $faker->domainWord,
        'time_zone' => $faker->countryCode,
    ];
});
