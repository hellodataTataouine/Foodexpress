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
        Schema::create('seos', function (Blueprint $table) {
            $table->id();
            $table->integer('client_id');
            $table->string('title')->nullable();
            $table->tinyText('description')->nullable();
            $table->text('keywords')->nullable();
            $table->string('robots',3)->nullable();
            $table->string('follow_links',3)->nullable();
            $table->string('content_type',35)->nullable();
            $table->string('language',20)->nullable();
            $table->string('image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seos');
    }
};
