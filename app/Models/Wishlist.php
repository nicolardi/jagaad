<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    use HasFactory;

     /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

    protected $fillable = array('user_id', 'name');
    
    protected $visible = array('id', 'user_id', 'name', 'created_at','updated_at');

    /**
     * Get wishlist_contents
     */
    public function wishlistContents()
    {
        return $this->hasMany('App\Models\WishlistContents');
    }
    
}
