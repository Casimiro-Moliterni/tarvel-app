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
            $table->unsignedBigInteger('id_day');
            $table->string('name');
            $table->string('image')->nullable();
            $table->string('description')->nullable();
            $table->double('longitude', 15, 8);
            $table->double('latitude', 15, 8);
            $table->string('foods')->nullable();
            $table->string('curiosities')->nullable();
            $table->string('rating');
            $table->timestamps();

            $table->foreign('id_day')->references('id')->on('days')->onDelete('cascade');
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
