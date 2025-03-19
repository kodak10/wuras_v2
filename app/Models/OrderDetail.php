<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;

    // Définition des colonnes qui peuvent être affectées par l'utilisateur (mass-assignment)
    protected $fillable = ['order_id', 'product_id', 'quantity', 'price'];

    /**
     * Relation inverse avec la commande (Order).
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function order()
    {
        return $this->belongsTo(Order::class); // Un détail appartient à une commande
    }

    /**
     * Relation inverse avec le produit (Product).
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    
}
