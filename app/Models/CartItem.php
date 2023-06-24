<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    use HasFactory;

    protected $fillable = ['product_id','name','quantity','total'];

    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }
}
