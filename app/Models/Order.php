<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'status',
        'customer_id',
        'date',
        'total_price',
        'notes',
        'nif',
        'address',
        'payment_type',
        'payment_ref',
        'receipt_url',
    ];

    protected $attributes = [
        'payment_ref' => 'N/A', 
    ];

 
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }


    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}
