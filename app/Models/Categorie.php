<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Categorie extends Model
{
    use HasFactory;
    protected $fillable = ['name'];

    public function tshirt_images(): HasMany
    {
        return $this->hasMany(Tshirt_image::class);
    }
}
