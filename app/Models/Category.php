<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = ['name'];
    protected $table = 'categories';
    public $timestamps = false;
    
    public function tshirt_images(): HasMany
    {
        return $this->hasMany(Tshirt_image::class);
    }
}
