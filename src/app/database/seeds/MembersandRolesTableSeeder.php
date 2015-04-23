<?php

class MembersandRolesTableSeeder extends Seeder {

    public function run()
    {
        $m = new Member;
        $m->first_name = 'Robert';
        $m->last_name  = 'Doucette';
        $m->username   = 'pasteur';
        $m->password   = Hash::make(getenv('password'));
        $m->created_by = 1;
        $m->updated_by = 1;
        $m->save();

        foreach(array('administrator', 'membre', 'orateur') as $key => $value)
        {
            $r = new Role;
            $r->name      = $value;
            $r->created_by= 1;
            $r->updated_by= 1;
            $r->save();
        }

        foreach(array(1,2,3) as $r)
        {
            $m->roles()->attach($r, array(
                'created_by' => 1,
                'updated_by' => 1
            ));
        }

        $m = new Member;
        $m->first_name = 'Philip';
        $m->last_name  = 'Bell';
        $m->username   = '';
        $m->password   = '';
        $m->created_by = 1;
        $m->updated_by = 1;
        $m->save();
    }

}
