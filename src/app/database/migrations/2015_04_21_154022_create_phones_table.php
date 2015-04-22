<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePhonesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('phones', function(Blueprint $table)
		{
			$table->integer('member_id')->unsigned();
			$table->string('number');
			$table->string('type');
            $table->integer('created_by')->unsigned();
            $table->integer('updated_by')->unsigned();
			$table->timestamps();
            $table->primary(array('member_id', 'number'));
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
		Schema::drop('phones');
	}

}
