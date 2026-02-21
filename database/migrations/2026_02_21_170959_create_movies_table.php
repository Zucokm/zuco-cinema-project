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
    Schema::create('movies', function (Blueprint $table) {
        $table->id();
        $table->string('title');
        $table->text('description')->nullable();
        $table->string('imagePath')->nullable(); 
        $table->string('bgImagePath')->nullable(); 
        $table->integer('duration'); 
        $table->date('releaseDate');
        $table->string('director')->nullable();
        $table->string('genre')->nullable();
        $table->string('trailerLink')->nullable();
        $table->double('rating', 3, 1)->default(0.0); 
        $table->string('language')->default('English');
        $table->integer('likeCount')->default(0);
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movies');
    }
};
