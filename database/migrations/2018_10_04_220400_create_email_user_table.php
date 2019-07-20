<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmailUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('email_user', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('email_id');
            $table->unsignedInteger('user_id');
            $table->string('type');
            $table->unique(['email_id', 'user_id']);
            $table->unique(['user_id', 'type']);
            $table->foreign('email_id')->references('id')->on('emails')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('email_user');
    }
}
