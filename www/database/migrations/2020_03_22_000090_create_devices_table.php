<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDevicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('devices', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('user_id')->index();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('restrict');
            $table->integer('group_id')->index();
            $table->foreign('group_id')->references('id')->on('groups')->onDelete('restrict');
            $table->integer('type_id')->index();
            $table->foreign('type_id')->references('id')->on('devices_type')->onDelete('restrict');;
            $table->integer('module_id')->index();
            $table->foreign('module_id')->references('id')->on('protocols')->onDelete('restrict');
            $table->integer('protocol_id')->index();
            $table->foreign('protocol_id')->references('id')->on('protocols')->onDelete('restrict');
            $table->string('name');
            $table->string('address');
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
        Schema::dropIfExists('devices');

        Schema::drop('devices');
    }
}
