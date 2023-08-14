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
        
            Schema::create('option_produit_restaurant', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('option_restaurant_id');
                $table->unsignedBigInteger('produit_restaurant_id');
                // Add other fields for pivot table if needed
                $table->timestamps();
    
                $table->foreign('option_restaurant_id')->references('id')->on('options_restaurant')->onDelete('cascade');
                $table->foreign('produit_restaurant_id')->references('id')->on('produits_restaurant')->onDelete('cascade');
            });
        }
    
     
    public function down(): void
    {
        Schema::dropIfExists('option_produit_restaurant');
    }
};
