<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Devices extends Migration
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
            $table->string('display_name');
            $table->integer('group_id')->index();
            $table->foreign('group_id')->references('id')->on('groups');
            $table->integer('user_id')->index();
            $table->foreign('user_id')->references('id')->on('users');
            $table->integer('type_id')->index();
            $table->foreign('type_id')->references('id')->on('devices_type');
            $table->tinyInteger('status');
            $table->timestamps();
        });

        DB::statement('ALTER TABLE devices ADD ip VARBINARY(16)');
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
