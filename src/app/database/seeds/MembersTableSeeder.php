<?php

class MembersTableSeeder extends Seeder {

    public function run()
    {
        $members = array(
            array(
                'first' => 'Robert',
                'last'  => 'Doucette',
                'email' => 'pasteur@ebbv.fr',
                'pass'  => 'password'
            ),
            array(
                'first' => 'Philip',
                'last'  => 'Bell',
                'email' => '',
                'pass'  => ''
            )
        );
        foreach($members as $key => $value)
        {
            $m = new Member;
            $m->first_name = $value['first'];
            $m->last_name  = $value['last'];
            $m->email      = $value['email'];
            $m->password   = Hash::make($value['pass']);
            $m->created_by = 1;
            $m->updated_by = 1;
            $m->save();
        }
    }

}
