<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArticleBarcode extends Model
{
    use HasFactory;
     // Définir la table associée si elle ne suit pas la convention Laravel
     protected $table = 'article_barcode'; 
     

    // Définir les colonnes autorisées pour la mise à jour
    protected $fillable = [
        'product_id', 'barcode_path',
    ];

    // Relation avec l'article
    public function article()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
