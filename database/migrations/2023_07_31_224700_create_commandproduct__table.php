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
        Schema::create('commandproduct', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('command_id');
            $table->unsignedBigInteger('product_id');
            $table->integer('quantity');
            // Add other fields for command products
    
            $table->foreign('command_id')->references('id')->on('commands')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('produits_restaurant')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('commandproduct');
    }
};
