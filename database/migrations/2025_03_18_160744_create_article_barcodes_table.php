<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
       

        Schema::create('article_barcode', function (Blueprint $table) {
            $table->id(); // ID pour l'enregistrement
            $table->foreignId('product_id') // Clé étrangère pour l'article
                  ->constrained('products') // Contrainte vers la table `articles`
                  ->onDelete('cascade'); // Suppression en cascade de l'article
           
            $table->text('barcode_path')->nullable()->change();

            $table->timestamps(); // Colonnes `created_at` et `updated_at`
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('article_barcodes');
    }
};
