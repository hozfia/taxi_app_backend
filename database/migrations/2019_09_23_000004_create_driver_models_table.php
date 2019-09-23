<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDriverModelsTable extends Migration
{
    public function up()
    {
        Schema::create('driver_models', function (Blueprint $table) {
            $table->increments('id');

            $table->string('driver_name');

            $table->string('driver_phone');

            $table->string('driver_location');

            $table->string('car_type');

            $table->string('car_color');

            $table->timestamps();

            $table->softDeletes();
        });
    }
}
