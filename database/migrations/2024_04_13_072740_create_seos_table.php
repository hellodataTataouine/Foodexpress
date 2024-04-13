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
            $table->string('title');
            $table->tinyText('description');
            $table->text('keywords');
            $table->string('robots',3);
            $table->string('follow_links',3);
            $table->string('content_type',35);
            $table->string('language',20);
            $table->string('image')->default(null);
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
