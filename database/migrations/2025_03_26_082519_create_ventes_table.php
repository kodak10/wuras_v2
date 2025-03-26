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
        Schema::create('ventes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained('products')->onDelete('cascade'); // référence à la table des produits
            $table->integer('quantity'); // Quantité du produit vendu
            $table->decimal('price', 10, 2); // Prix de l'article avant réduction
            $table->decimal('discount', 10, 2)->default(0); // Remise appliquée sur l'article
            $table->decimal('total', 10, 2); // Total après remise par article
            $table->unsignedBigInteger('user_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ventes');
    }
};
