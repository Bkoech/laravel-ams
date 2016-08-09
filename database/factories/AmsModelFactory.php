<?php

$factory->define(\Wilgucki\LaravelAms\Models\Role::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name
    ];
});

$factory->define(\Wilgucki\LaravelAms\Models\Admin::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->safeEmail,
        'password' => str_random(10),
        'remember_token' => str_random(10),
    ];
});

$factory->define(\Wilgucki\LaravelAms\Models\AclResource::class, function (Faker\Generator $faker) {
    return [
        'controller' => $faker->word,
        'action' => $faker->word,
        'methods' => $faker->word.','.$faker->word,
    ];
});
