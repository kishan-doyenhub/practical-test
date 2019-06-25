<?php

use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        for($i = 0; $i < 50; $i++) {
            App\Order::create([
                'customer_id'    => rand(1,200),
                'invoice_number' => rand(1,500),
                'total_amount'   => rand(1,500),
                'status'         => 'new'
            ]);
        }
    }
}
