<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call('MembersandRolesTableSeeder');
        $this->call('MessagesTableSeeder');
        $this->call('PhonesTableSeeder');
        $this->call('AddressesTableSeeder');
        $this->call('EmailsTableSeeder');

        Model::reguard();
    }
}
