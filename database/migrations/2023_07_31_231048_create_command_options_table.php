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
        Schema::create('command_options', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('command_id');
            $table->unsignedBigInteger('option_restaurant_id');
            $table->timestamps();
    
            $table->foreign('command_id')->references('id')->on('commands')->onDelete('cascade');
            $table->foreign('option_restaurant_id')->references('id')->on('options_restaurant')->onDelete('cascade');
      
          
        });
    
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('command_options');
    }
};
