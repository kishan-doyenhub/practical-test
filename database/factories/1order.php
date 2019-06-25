<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\Order::class, function (Faker $faker) {
    return [
        'customer_id'    => rand(1,200),
        'invoice_number' => rand(1,500),
        'total_amount'   => rand(1,500),
        'status'         => 'new'
    ];
});
