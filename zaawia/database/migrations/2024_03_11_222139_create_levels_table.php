<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('levels', function (Blueprint $table) {
            // $table->id('level_id');
            // $table->unsignedBigInteger('game_id');
            // $table->integer('level_number');
            // $table->boolean('child_answer')->default(false);


            // $table->foreign('game_id')->references('game_id')->on('games');

            // $table->timestamps();
            $table->unsignedBigInteger('level_id');
            $table->unsignedBigInteger('game_id');
            $table->integer('level_number');
            $table->boolean('child_answer')->default(false);

            $table->primary(['level_id', 'game_id']);

            $table->foreign('game_id')->references('game_id')->on('games');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('levels');
    }
};
