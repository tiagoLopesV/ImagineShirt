<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;


class TshirtImage extends Model
{
    use HasFactory;
    use SoftDeletes;
    public $timestamps = false;
    protected $table = 'tshirt_images';
    protected $fillable = ['name', 'description', 'image_url', 'optional'];

    public function customer(): HasOne
    {
        return $this->hasOne(Customer::class);
    }

    public function categoryRef(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function orders(): BelongsToMany
    {
        return $this->belongsToMany(Order::class, 'order_items');
    }

    protected function tshirtPhotoUrl(): Attribute
{
    return Attribute::make(
    get: function () {
    return $this->image_url ? asset('storage/tshirt_images/' . $this->image_url) : asset('/img/avatar_unknown.png');
    },
    );
}
}
