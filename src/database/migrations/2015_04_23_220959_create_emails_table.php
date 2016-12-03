<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmailsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('emails', function (Blueprint $table) {
			$table->integer('member_id')->unsigned();
			$table->string('address')->unique();
			$table->string('type');
    		$table->integer('created_by')->unsigned();
    		$table->integer('updated_by')->unsigned();
			$table->timestamps();
    		$table->primary(['member_id', 'address']);
    		$table->foreign('member_id')->references('id')->on('members');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('emails');
	}
}
