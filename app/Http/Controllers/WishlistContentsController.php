<?php

namespace App\Http\Controllers;

use App\Models\WishlistContents;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * WishlistContentsController
 * 
 * Wishlist contents
 */
class WishlistContentsController extends Controller
{
    use ApiResponse;
    
    /**
     * list of the user wishlist contents
     *
     * @return JsonResponse
     */
    public function index()
    {
        $wishlists_contents = WishlistContents::all();
        return $this->successResponse($wishlists_contents);
    }
    
    /**
     * Store (create) a product in an existing wishlist
     *
     * @param  Request $request
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        $data = $request->input();
        $wishlistContents = WishlistContents::create($data);
        return $this->successResponse($wishlistContents);
    }
    
    /**
     * Updates (patch) a product in an existing wishlist
     *
     * @param  Request $request
     * @param  integer $id
     * @return JsonResponse
     */
    public function update(Request $request, $id)
    {
        $wishlistContents = WishlistContents::find($id);
        $data = $request->input();
        $wishlistContents->update($data);

        return $this->successResponse($wishlistContents);
    }
    
    /**
     * Remove a product from a wishlist
     *
     * @param integer $id
     * @return JsonResponse
     */
    public function destroy($id)
    {
        $wishlistContents = WishlistContents::find($id);
        $wishlistContents->delete();
        return $this->successResponse(null);
    }
}
