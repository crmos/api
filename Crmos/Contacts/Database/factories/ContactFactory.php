<?php

use Faker\Generator as Faker;

/* @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(\Crmos\Contacts\Models\Contact::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
    ];
});
