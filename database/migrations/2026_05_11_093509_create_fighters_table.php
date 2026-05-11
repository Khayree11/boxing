<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('fighters', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('photo')->nullable(); // Menyimpan path foto
            $table->integer('height_cm'); // Input dalam cm
            $table->integer('weight_kg'); // Input dalam kg
            $table->string('country');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fighters');
    }
};
