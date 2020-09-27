<?php

namespace App\Helpers;

use App\Models\Wishlist;
use App\Models\WishlistContents;
use Illuminate\Support\Str;
/**
 * TestsHelper class 
 * 
 * Simplified Fake data creation
 */
class TestsHelper
{
    public static function randomName() 
    {
        return Str::random();
    }
    /**
     * Create a new wishlist
     *
     * @return Wishlist
     */
    public static function createWishlist(): Wishlist
    {

        $wl = new Wishlist();
        $wl->user_id = 1;
        $wl->name = static::randomName(); // Random name
        $wl->save();
        return $wl;
    }

    /**
     * Create a wishlist contents
     *
     * @param  mixed $wl
     * @return WishlistContents
     */
    public static function  createWishlistContents(Wishlist $wl): WishlistContents
    {
        // Create a new Wishlist content
        $wlContent = new WishlistContents();
        $wlContent->wishlist_id = $wl->id;
        $wlContent->product_id = 1;
        $wlContent->save();
        return $wlContent;
    }
}
