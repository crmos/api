<?php

use Faker\Generator as Faker;

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(\Crmos\Foundation\Models\LegalDocument::class, function (Faker $faker) {
    return [
        'description' => $faker->randomElement(['cpf', 'rg']),
        'number' => $faker->numerify(),
        'dispatcher' => $faker->word,
        'state' => $faker->word,
        'country' => $faker->country,
    ];
});
