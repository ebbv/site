<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeUniqueIndexToPrimaryKeyOnEmailUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('email_user', function (Blueprint $table) {
            $table->dropForeign(['email_id']);
            $table->dropForeign(['user_id']);
            $table->dropUnique(['email_id', 'user_id', 'type']);
            $table->primary(['email_id', 'user_id']);
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
        Schema::table('email_user', function (Blueprint $table) {
            $table->dropForeign(['email_id']);
            $table->dropForeign(['user_id']);
            $table->dropPrimary(['email_id', 'user_id']);
            $table->unique(['email_id', 'user_id', 'type']);
            $table->foreign('email_id')->references('id')->on('emails')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }
}
