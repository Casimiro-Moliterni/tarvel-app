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
        Schema::create('stops', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_trip');
            $table->date('day');
            $table->string('name');
            $table->string('image')->nullable();
            $table->string('description')->nullable();
            $table->string('country')->nullable();
            $table->string('region')->nullable();
            $table->string('city');
            $table->string('street')->nullable();
            $table->string('foods')->nullable();
            $table->string('curiosities')->nullable();
            $table->string('rating');
            $table->timestamps();

            $table->foreign('id_trip')->references('id')->on('trips')->onDelete('cascade');
        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stops');
    }
};
