<?php

class MembersTableSeeder extends Seeder {

    public function run()
    {
        $member = new Member;
        $member->first_name = 'Robert';
        $member->last_name  = 'Doucette';
        $member->email      = 'pasteur@ebbv.fr';
        $member->password   = Hash::make('password');
        $member->created_by = 1;
        $member->updated_by = 1;
        $member->save();
    }

}