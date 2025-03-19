<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
  
    use HasFactory;

    protected $fillable = ['path', 'is_thumbnail'];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_image');
    }

    public function isThumbnail()
    {
        return $this->is_thumbnail;
    }
}