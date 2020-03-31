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
            $table->string('display_name');
            $table->integer('group_id')->index();
            $table->foreign('group_id')->references('id')->on('groups')->onDelete('restrict');
            $table->integer('user_id')->index();
            $table->foreign('user_id')->references('id')->on('users');
            $table->integer('type_id')->index();
            $table->foreign('type_id')->references('id')->on('devices_type')->onDelete('restrict');;
            $table->integer('module_id')->index()->nullable();
            $table->foreign('module_id')->references('id')->on('modules')->onDelete('restrict');
            $table->json('last_data')->nullable();
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
