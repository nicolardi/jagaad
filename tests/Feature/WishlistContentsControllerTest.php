<?php

namespace Tests\Feature;

use App\Helpers\TestsHelper;
use App\Models\Wishlist;
use App\Models\WishlistContents;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;
use Illuminate\Support\Str;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class WishlistContentsControllerTest extends TestCase
{
   // use RefreshDatabase;
   // use WithoutMiddleware;

    /**
     * @var Wishlist
     * */
    private $wishlist;
    /**
     * @var WishlistContents
     * */
    private $wishlistContents;

    protected function setUp(): void 
    {
        parent::setUp();

        $this->wishlist = TestsHelper::createWishlist();
        $this->wishlistContents = TestsHelper::createWishlistContents($this->wishlist);
    }

    

    /**
     * Wishlist Content creation POST /api/wishlist_contents
     *
     * @return void
     */
    public function testStore()
    {
        $response = $this->postJson('/api/wishlist_contents', [
            "wishlist_id" => $this->wishlistContents->id, 
            "product_id" => 1]
        );
        $response->assertStatus(200);
        $response->assertJson(['status' => 'OK', 'data' => [
            "wishlist_id" => $this->wishlistContents->id, 
            "product_id" => 1
        ]]);
    }

    /**
     * Wishlist destroy DELETE api/wishlist/id
     *
     * @return void
     */
    public function testDestroy()
    {

        // Delete wishlist contents
        $response = $this->delete('/api/wishlist_contents/' . $this->wishlistContents->id);
        $response->assertStatus(200);
        $response->assertJson(['status' => 'OK', 'data' => null]);

        $item = DB::table('wishlists_contents')->find($this->wishlistContents->id);
        $this->assertNull($item);
    }
    

}
