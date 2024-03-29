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
        Schema::create('games', function (Blueprint $table) {
            $table->id('game_id');
            $table->string('game_name', 50);
            $table->unsignedBigInteger('skill_id')->nullable();
            $table->boolean('is_completed')->default(false);


            $table->foreign('skill_id')->references('skill_id')->on('skills');
            // $table->foreignId('child_id')->constrained('child')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('games');
    }
};
