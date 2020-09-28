<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\Auth\Controller;
use App\Models\Wishlist;
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
     * Store (create) a product in an existing wishlist
     *
     * @param  Request $request
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        $wishlist = Wishlist::find($request->input('wishlist_id'));
        
        if (!$wishlist) {
           return $this->errorResponse('Unknown wishlist');
        }

        $user_id = $request->input('user_id');
        if ($wishlist->id != $user_id) {
            return $this->errorResponse('Item is not public');
        }

        $data = $request->input();
        $wishlistContents = WishlistContents::create($data);
        return $this->successResponse($wishlistContents);
    }
    
    /**
     * Remove a product from a wishlist
     *
     * @param integer $id
     * @return JsonResponse
     */
    public function destroy(Request $request, $id)
    {
        $wishlistContents = WishlistContents::find($id);
        $wishlist = Wishlist::find($wishlistContents->wishlist_id);

        if (!$wishlist) {
            return $this->errorResponse('Unknown wishlist');
         }
 
         $user_id = $request->input('user_id');
         if ($wishlist->id != $user_id) {
             return $this->errorResponse('Item is not public');
         }
         
        $wishlistContents->delete();
        return $this->successResponse(null);
    }
}
