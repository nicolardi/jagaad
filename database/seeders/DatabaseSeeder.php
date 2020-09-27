<?php

namespace Database\Seeders;

use DateTime;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // Create two fake products

        $current_time = new DateTime();
        
        DB::table('users')->truncate();
        DB::table('products')->truncate();
        DB::table('wishlists')->truncate();
        DB::table('wishlists_contents')->truncate();

        $product_id1 = DB::table('products')->insertGetId([
            'name' => Str::random(10),
            'description' => Str::random(100),
            'created_at' => $current_time,
            'updated_at' => $current_time
        ]);

        $product_id2 = DB::table('products')->insertGetId([
            'name' => Str::random(10),
            'description' => Str::random(100),
            'created_at' => $current_time,
            'updated_at' => $current_time
        ]);


        // Create two fake users
        $user_id1 = DB::table('users')->insertGetId([
            'name' => Str::random(10),
            'email' => 'fake@email.com',
            'password' => '12345678',
            'email_verified_at' => new DateTime(),
            'created_at' => $current_time,
            'updated_at' => $current_time
        ]);
        
        $user_id2 = DB::table('users')->insertGetId([
            'name' => Str::random(10),
            'email' => 'fake2@email.com',
            'password' => '12345678',
            'email_verified_at' => new DateTime(),
            'created_at' => $current_time,
            'updated_at' => $current_time
        ]);

        // Create one wishlist for user1
        $wl1 = DB::table('wishlists')->insertGetId([
            'user_id' => $user_id1,
            'name' => 'User 1 wishlist',
            'created_at' => $current_time,
            'updated_at' => $current_time
        ]);

        // Create one wishlist for user2
        $wl2 = DB::table('wishlists')->insertGetId([
            'user_id' => $user_id2,
            'name' => 'User 2 wishlist',
            'created_at' => $current_time,
            'updated_at' => $current_time
        ]);


        // Inserts p1 into user1's wishlist
        DB::table('wishlists_contents')->insert([
            'wishlist_id' => $wl1,
            'product_id' => $product_id1,
            'created_at' => $current_time,
            'updated_at' => $current_time
        ]);
        
        // Inserts p2 into user2's wishlist
        DB::table('wishlists_contents')->insert([
            'wishlist_id' => $wl2,
            'product_id' => $product_id2,
            'created_at' => $current_time,
            'updated_at' => $current_time
        ]);
    }
}
