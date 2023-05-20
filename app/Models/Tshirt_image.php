<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Disciplina extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['name', 'description', 'image_url', 'optional'];

    public function costumer(): HasOne
    {
        return $this->hasOne(Costumer::class);
    }

    public function categorieRef(): BelongsTo
    {
        return $this->belongsTo(Categorie::class);
    }

    public function orders(): BelongsToMany
    {
        return $this->belongsToMany(Order::class, 'order_items');
    }
}
