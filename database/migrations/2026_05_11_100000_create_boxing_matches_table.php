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
        Schema::create('boxing_matches', function (Blueprint $table) {
        $table->id();
        $table->foreignId('fighter_a_id')->constrained('fighters')->onDelete('cascade');
        $table->foreignId('fighter_b_id')->constrained('fighters')->onDelete('cascade');
        $table->dateTime('scheduled_at');
        $table->enum('status', ['coming_soon', 'on_going', 'finished'])->default('coming_soon');
        $table->string('winner')->nullable(); 
        $table->string('youtube_link')->nullable();
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('boxing_matches');
    }
};
