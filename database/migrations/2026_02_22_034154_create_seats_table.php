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
        Schema::create('seats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cinema_hall_id')->constrained()->cascadeOnDelete();

            $table->foreignId('seat_type_id')->constrained()->cascadeOnDelete();

            $table->string('row'); 
            $table->integer('number'); 
            $table->string('seat_code'); 

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seats');
    }
};
