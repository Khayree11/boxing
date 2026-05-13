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
        Schema::table('boxing_matches', function (Blueprint $table) {
            $table->string('thumbnail')->nullable();
            $table->string('location')->nullable();
            $table->string('gmaps_link')->nullable();
            $table->string('ticket_link')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('boxing_matches', function (Blueprint $table) {
            //
        });
    }
};
