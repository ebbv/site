<?php

class EmailsTableSeeder extends DatabaseSeeder
{
    public function run()
    {
        $e = new App\Models\Email;
        $e->member_id   = 1;
        $e->address     = 'pasteur@ebbv.fr';
        $e->type        = 0;
        $e->created_by  = 1;
        $e->updated_by  = 1;
        $e->save();
    }
}
