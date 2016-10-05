<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRolesTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('roles', function(Blueprint $table) {
      $table->increments('id');
      $table->string('name');
      $table->integer('created_by')->unsigned();
      $table->integer('updated_by')->unsigned();
      $table->timestamps();
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
    Schema::drop('roles');
  }
}
