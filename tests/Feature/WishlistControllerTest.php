<?php

namespace Tests\Unit;

use App\Helpers\TestsHelper;
use App\Models\Wishlist;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

use Illuminate\Foundation\Testing\WithoutMiddleware;

class WishlistControllerTest extends TestCase
{
   // use RefreshDatabase;
   // use WithoutMiddleware;

    protected $wishlist;
    protected $wishlistContents;

    protected function setUp(): void 
    {
        parent::setUp();
        $this->wishlist = TestsHelper::createWishlist();
        $this->wishlistContents = TestsHelper::createWishlistContents($this->wishlist);
    }

    /**
     * Test the GET /api/wishlist
     *
     * @return void
     */
    public function testIndex()
    {
        $response = $this->get('/api/wishlist');
        $response->assertStatus(200);
        $response->assertJson(['status' => 'OK']);
        $responseJson = $response->getData();
        $data = $responseJson->data;
        $this->assertIsArray($data);
    }

    /**
     * Test the GET /api/wishlist/id
     *
     * @return void
     */
    public function testShow()
    {
        $response = $this->get('/api/wishlist/'.$this->wishlist->id);
        $response->assertStatus(200);
        $response->assertJson(['status' => 'OK']);
        $responseJson = $response->getData();
        $data = $responseJson->data;
      
        $this->assertIsObject($data->wishlist);
        $this->assertIsArray($data->items);

    }

    /**
     * Wishlist creation POST /api/wishlist
     *
     * @return void
     */
    public function testStore()
    {
        $response = $this->postJson('/api/wishlist', ["user_id" => 1, "name" => "my test wishlist"]);
        $response->assertStatus(200);
        $response->assertJson(['status' => 'OK', 'data' => [
            'user_id' => 1,
            'name' => 'my test wishlist'
        ]]);
    }

    /**
     * Wishlist update PATCH /api/wishlist/id
     *
     * @return void
     */
    public function testUpdate()
    {
        // Update test

        // New wishlist name
        $wishlistName = TestsHelper::randomName();
        $response = $this->patchJson('/api/wishlist/' . $this->wishlist->id, ["user_id" => 1, "name" => $wishlistName]);
        $response->assertStatus(200);
        $response->assertJson(['status' => 'OK', 'data' => [
            'user_id' => 1,
            'name' => $wishlistName
        ]]);
    }

    /**
     * Wishlist destroy DELETE api/wishlist/id
     *
     * @return void
     */
    public function testDestroy()
    {
        // Create a new wishlist
        $wl = TestsHelper::createWishlist();

        $response = $this->delete('/api/wishlist/' . $wl->id);
        $response->assertStatus(200);
        $response->assertJson(['status' => 'OK', 'data' => null]);

        $item = DB::table('wishlists')->find($wl->id);
        $this->assertNull($item);
    }
}
