<?php

use Illuminate\Database\Seeder;

class OrderItemSeeder extends Seeder
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
            App\OrderItem::create([
                'order_id'    => rand(1,50),
                'product_id'  => rand(1,100),
                'quantity'    => rand(1,500),
            ]);
        }
    }
}
