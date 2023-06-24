<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use HasFactory;
    use SoftDeletes;
    public $incrementing=false;

    protected $fillable = [
        'id', 
        'nif', 
        'address', 
        'default_payment_type', 
        'default_payment_ref'
    ];


    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id', 'id');
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    public function tshirst_images(): HasMany
    {
        return $this->hasMany(tshirt_image::class);
    }

}
