<?php

class PhonesTableSeeder extends DatabaseSeeder
{
    public function run()
    {
        $phones = [
            [
                'id'    => 1,
                'number'=> '02.32.51.24.37',
                'type'  => 'Fixe'
            ],
            [
                'id'    => 1,
                'number'=> '06.45.08.98.08',
                'type'  => 'Port'
            ]
        ];

        foreach ($phones as $key => $value) {
            $p = new App\Models\Phone;
            $p->member_id  = $value['id'];
            $p->number     = $value['number'];
            $p->type       = $value['type'];
            $p->created_by = 1;
            $p->updated_by = 1;
            $p->save();
        }
    }
}
