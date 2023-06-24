<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $fillable = [
        'order_id',
        'tshirt_image_id',
        'color_code',
        'size',
        'qty',
        'unit_price',
        'sub_total',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
