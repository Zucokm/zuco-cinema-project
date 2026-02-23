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
    Schema::create('food_items', function (Blueprint $table) {
        $table->id();
    
        $table->foreignId('food_type_id')->constrained()->cascadeOnDelete();
        
        $table->string('name'); 
        $table->text('description')->nullable();
        $table->integer('price'); 
        $table->string('imagePath')->nullable(); 
        $table->boolean('isActive')->default(true); 
        
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('food_items');
    }
};
