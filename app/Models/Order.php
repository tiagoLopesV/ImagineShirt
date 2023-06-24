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
        'payment_ref' => 'N/A', // Set a default value for 'payment_ref' field
    ];

    // Define the relationship with the Customer model
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    // Define the relationship with the OrderItem model
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}
