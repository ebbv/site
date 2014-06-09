<?php

class RolesTableSeeder extends Seeder {

    public function run()
    {
        $role1 = new Role;
        $role1->name      = 'administrateur';
        $role1->created_by= 1;
        $role1->updated_by= 1;
        $role1->save();
        $role2 = new Role;
        $role2->name      = 'membre';
        $role2->created_by= 1;
        $role2->updated_by= 1;
        $role2->save();
        $role3 = new Role;
        $role3->name      = 'orateur';
        $role3->created_by= 1;
        $role3->updated_by= 1;
        $role3->save();
    }

}