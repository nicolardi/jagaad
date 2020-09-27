<?php

namespace App\Http\Controllers;

use App\Models\Wishlist;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

/**
 * WishlistController
 * 
 * Wishlist API methods
 * 
 * @author Massimo Nicolardi
 */
class WishlistController extends Controller
{
    use ApiResponse;
    
    /**
     * list the user wishlist
     *
     * @return JsonResponse
     */
    public function index()
    {
        $wishlist = Wishlist::all();
        return $this->successResponse($wishlist);
    }

    public function show($id) {
        $wishlist = Wishlist::find($id);
        $ret = [
            'wishlist' => $wishlist,
            'items' => $wishlist->wishlistContents
        ];
        return $this->successResponse($ret);
    }
        
    /**
     * Store (create) a new wishlist
     * 
     * @param  Request $request
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        $data = $request->input();
        $wishlist = Wishlist::create($data);

        return $this->successResponse($wishlist);
    }
        
    /**
     * Update a wishlist (PATCH)
     *
     * @param  Request $request
     * @param  Wishlish $wishlist
     * @return JsonResponse
     */
    public function update(Request $request, Wishlist $wishlist)
    {
        $data = $request->input();
        $wishlist->update($data);

        return $this->successResponse($wishlist);
    }
        
    /**
     * Remove a wishlist (DELETE)
     *
     * @param  Wishlist $wishlist
     * @return JsonResponse
     */
    public function destroy(Wishlist $wishlist)
    {
        $wishlist->delete();
        return $this->successResponse(null);
    }
}
