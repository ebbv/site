<?php

class EmailsTableSeeder extends Seeder {

    public function run()
    {
        $e = new Email;
        $e->member_id   = 1;
        $e->address     = 'pasteur@ebbv.fr';
        $e->type        = '';
        $e->created_by  = 1;
        $e->updated_by  = 1;
        $e->save();
    }

}
