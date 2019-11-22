<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificationTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notification_types', function (Blueprint $table) {
            $table->increments('id');
            $table->string('class_name');
            $table->string('display_name');
            $table->boolean('status')->default(true);
        });

        Schema::create('notification_settings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->morphs('notifiable');
            $table->integer('type_id')->unsigned();
            $table->boolean('status')->default(true);
            $table->timestamps();

            $table->foreign('type_id')
                ->references('id')->on('notification_types')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notification_settings');
        Schema::dropIfExists('notification_types');
    }
}
