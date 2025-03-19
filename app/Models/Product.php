<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name', 'category_id', 'marque', 'weight', 'description', 'stock', 'price', 'discount', 'colors', 'tags','slug','image_path'
    ];

    protected $casts = [
        'colors' => 'array',
        'tags' => 'array',
    ];

    public function images()
    {
        return $this->belongsToMany(Image::class, 'product_image');
    }

    public function thumbnail()
    {
        return $this->hasOne(Image::class)->where('is_thumbnail', true);
    }
    

    public function category()
    {
        return $this->belongsTo(Category::class); // Relation "Un produit appartient à une catégorie"
    }
}
