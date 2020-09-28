<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\Auth\Controller;
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
    public function index(Request $request)
    {
        $userid = $request->input('user_id');
        $wishlist = Wishlist::query()->where('user_id', '=', $userid)->get();
        return $this->successResponse($wishlist);
    }

    public function show(Request $request, $id)
    {
        
        $wishlist = Wishlist::find($id);
        $userid = $request->input('user_id');
        if ($userid && $wishlist->user_id != $userid) {
           return $this->errorResponse('This item is not public');
        }

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
        $user_id = $request->input('user_id');
        if ($user_id != $wishlist->user_id) {
            return $this->errorResponse('This item is not public');
        }
        $wishlist->update($data);

        return $this->successResponse($wishlist);
    }

    /**
     * Remove a wishlist (DELETE)
     *
     * @param  Wishlist $wishlist
     * @return JsonResponse
     */
    public function destroy(Request $request, Wishlist $wishlist)
    {
        $user_id = $request->input('user_id');
        if ($user_id != $wishlist->user_id) {
            return $this->errorResponse('This item is not public');
        }
        $wishlist->delete();
        return $this->successResponse(null);
    }
}
