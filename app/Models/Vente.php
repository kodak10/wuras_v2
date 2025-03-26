<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vente extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'quantity',
        'price',
        'discount',
        'total',
        'user_id',
    ];

    // public function produit()
    // {
    //     return $this->belongsTo(Product::class);
    // }
    public function produit()
    {
        return $this->belongsTo(Product::class, 'product_id'); // Assurez-vous que 'product_id' est bien la clé étrangère
    }

   
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
