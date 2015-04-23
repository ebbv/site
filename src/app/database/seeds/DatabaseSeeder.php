<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		$this->call('MembersandRolesTableSeeder');
		$this->call('MessagesTableSeeder');
		$this->call('PhonesTableSeeder');
		$this->call('AddressesTableSeeder');
		$this->call('EmailsTableSeeder');
	}

}