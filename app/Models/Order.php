<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Order extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'customer_id', 
        'status', 
        'date', 
        'total_price', 
        'notes', 
        'nif', 
        'adress', 
        'payment_type', 
        'payment_ref'
    ];

    public function customerRef(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function tshirt_images(): BelongsToMany
    {
        return $this->belongsToMany(tshirt_image::class, 'order_items');
    }

    public function colors(): BelongsToMany
    {
        return $this->belongsToMany(Color::class, 'order_items', 'color_code');
    }
}
