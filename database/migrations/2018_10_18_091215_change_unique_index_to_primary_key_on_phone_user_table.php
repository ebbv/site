<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeUniqueIndexToPrimaryKeyOnPhoneUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('phone_user', function (Blueprint $table) {
            $table->dropForeign(['phone_id']);
            $table->dropForeign(['user_id']);
            $table->dropUnique(['phone_id', 'user_id']);
            $table->primary(['phone_id', 'user_id']);
            $table->foreign('phone_id')->references('id')->on('phones')->onDelete('cascade');
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
        Schema::table('phone_user', function (Blueprint $table) {
            $table->dropForeign(['phone_id']);
            $table->dropForeign(['user_id']);
            $table->dropPrimary(['phone_id', 'user_id']);
            $table->unique(['phone_id', 'user_id']);
            $table->foreign('phone_id')->references('id')->on('phones')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }
}
