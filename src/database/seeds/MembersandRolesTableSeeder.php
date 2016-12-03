<?php

use App\Models\Member;
use App\Models\Role;

class MembersandRolesTableSeeder extends DatabaseSeeder
{
    public function run()
    {
        $m = new Member;
        $m->first_name = 'Robert';
        $m->last_name  = 'Doucette';
        $m->username   = 'pasteur';
        $m->password   = Hash::make(env('DB_PASSWORD'));
        $m->created_by = 1;
        $m->updated_by = 1;
        $m->save();

        foreach (['administrateur', 'membre', 'orateur'] as $key => $value) {
            $r = new Role;
            $r->name      = $value;
            $r->created_by= 1;
            $r->updated_by= 1;
            $r->save();
        }

        foreach ([1, 2, 3] as $r) {
            $m->roles()->attach($r, [
                'created_by' => 1,
                'updated_by' => 1
            ]);
        }

        $m = new Member;
        $m->first_name = 'Philip';
        $m->last_name  = 'Bell';
        $m->username   = '';
        $m->password   = '';
        $m->created_by = 1;
        $m->updated_by = 1;
        $m->save();
        $m->roles()->attach(3, [
            'created_by' => 1,
            'updated_by' => 1
        ]);

        $m = new Member;
        $m->first_name = '';
        $m->last_name  = '';
        $m->username   = 'membre';
        $m->password   = Hash::make('Vernon');
        $m->created_by = 1;
        $m->updated_by = 1;
        $m->save();

        $m = new Member;
        $m->first_name = '';
        $m->last_name  = '';
        $m->username   = 'test_user';
        $m->password   = '';
        $m->created_by = 1;
        $m->updated_by = 1;
        $m->save();
        $m->roles()->attach(1, [
            'created_by' => 1,
            'updated_by' => 1
        ]);
    }
}
