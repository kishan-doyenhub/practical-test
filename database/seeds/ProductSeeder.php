<?php

use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        for($i = 0; $i < 100; $i++) {
            App\Product::create([
                'name'      => $faker->company,
                'price'     => rand(1,500),
                'in_stock'  => rand(1,500),
            ]);
        }
    }
}
