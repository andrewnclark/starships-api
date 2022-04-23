<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('armament_starship', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('quantity');
            $table->unsignedBigInteger('armament_id');
            $table->unsignedBigInteger('starship_id');
            $table->timestamps();

            $table->foreign('armament_id')->references('id')->on('armaments');
            $table->foreign('starship_id')->references('id')->on('starships');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('armament_starship');
    }
};
