<?php

use Illuminate\Database\Seeder;
use Silber\Bouncer\BouncerFacade as Bouncer;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adminuser = DB::table('users')->insert([
            'name' => 'Administrator',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('adminuser'),
        ]);
        $admin1 = Bouncer::role()->firstOrCreate([
            'name' => 'admin',
            'title' => 'Administrator',
        ]);
        
        // $ban1 = Bouncer::ability()->firstOrCreate([
        //     'name' => 'admin',
        //     'title' => 'Administrator',
        // ]);
        
        // Bouncer::allow($admin1)->to($ban1);
        Bouncer::assign('admin')->to($adminuser);
        // ============================================================================

        $user = DB::table('users')->insert([
            'name' => 'User',
            'email' => 'usermanager@gmail.com',
            'password' => bcrypt('usermanager'),
        ]);
        $admin2 = Bouncer::role()->firstOrCreate([
            'name' => 'user',
            'title' => 'User-Manager',
        ]);
        
        // $ban2 = Bouncer::ability()->firstOrCreate([
        //     'name' => 'users',
        //     'title' => 'User-Manager',
        // ]);
        
        // Bouncer::allow($admin1)->to($ban2);
        // Bouncer::allow($admin2)->to($ban2);
        Bouncer::assign('user')->to($user);
        // ============================================================================

        $shopmanager = DB::table('users')->insert([
            'name' => 'Shop Manager',
            'email' => 'shopmanager@gmail.com',
            'password' => bcrypt('shopmanager'),
        ]);
        $admin3 = Bouncer::role()->firstOrCreate([
            'name' => 'shopmanager',
            'title' => 'Shop-Manager',
        ]);
        
        // $ban3 = Bouncer::ability()->firstOrCreate([
        //     'name' => 'shop-manager-users',
        //     'title' => 'Shop-Manager',
        // ]);
        
        // Bouncer::allow($admin1)->to($ban3);
        // Bouncer::allow($admin3)->to($ban3);
        Bouncer::assign('shopmanager')->to($shopmanager);
        // ============================================================================

        $ban4 = Bouncer::ability()->firstOrCreate([
            'name' => 'product',
            'title' => 'Product',
        ]);
        $ban5 = Bouncer::ability()->firstOrCreate([
            'name' => 'order',
            'title' => 'Order',
        ]);
        $ban6 = Bouncer::ability()->firstOrCreate([
            'name' => 'customer',
            'title' => 'Customer',
        ]);
        Bouncer::allow($admin1)->to($ban4);
        Bouncer::allow($admin1)->to($ban5);
        Bouncer::allow($admin1)->to($ban6);
        Bouncer::allow($admin2)->to($ban6);
        Bouncer::allow($admin3)->to($ban4);
        Bouncer::allow($admin3)->to($ban5);

        // ============================================================================

    }
}
