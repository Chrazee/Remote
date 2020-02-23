<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DevicesType extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('devices_type', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('name')->unique();
            $table->string('display_name');
            $table->integer('icon_id')->index();
            $table->foreign('icon_id')->references('id')->on('devices_type_icon');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('devicetype');
    }
}
