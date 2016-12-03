<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMemberRoleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
    */
    public function up()
    {
        Schema::create('member_role', function (Blueprint $table) {
            $table->integer('member_id')->unsigned();
            $table->integer('role_id')->unsigned();
            $table->integer('created_by')->unsigned();
            $table->integer('updated_by')->unsigned();
            $table->timestamps();
            $table->primary(['member_id', 'role_id']);
            $table->foreign('member_id')->references('id')->on('members');
            $table->foreign('role_id')->references('id')->on('roles');
            $table->foreign('created_by')->references('id')->on('members');
            $table->foreign('updated_by')->references('id')->on('members');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('member_role');
    }
}
