<?php

class PhonesTableSeeder extends Seeder {

    public function run()
    {
        $phones = array(
            array(
                'id'    => 1,
                'number'=> '02.32.51.24.37',
                'type'  => 'Fixe'
            ),
            array(
                'id'    => 1,
                'number'=> '06.45.08.98.08',
                'type'  => 'Port'
            )
        );
        foreach($phones as $key => $value)
        {
            $p = new Phone;
            $p->member_id  = $value['id'];
            $p->number     = $value['number'];
            $p->type       = $value['type'];
            $p->created_by = 1;
            $p->updated_by = 1;
            $p->save();
        }
    }

}
