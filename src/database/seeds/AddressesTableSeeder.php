<?php

class AddressesTableSeeder extends Seeder {

    public function run()
    {
        $addresses = array(
            array(
                'id'    => 1,
                'num'   => 58,
                'type'  => 'rue',
                'name'  => 'du Vieux Château',
                'comp'  => '',
                'zip'   => '27200',
                'city'  => 'Vernon'
            )
        );
        foreach($addresses as $key => $value)
        {
            $a = new Address;
            $a->member_id       = $value['id'];
            $a->street_number   = $value['num'];
            $a->street_type     = $value['type'];
            $a->street_name     = $value['name'];
            $a->street_complement=$value['comp'];
            $a->zip             = $value['zip'];
            $a->city            = $value['city'];
            $a->created_by      = 1;
            $a->updated_by      = 1;
            $a->save();
        }
    }

}
