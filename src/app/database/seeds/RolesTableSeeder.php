<?php

class RolesTableSeeder extends Seeder {

    public function run()
    {
        foreach(array('administrator', 'membre', 'orateur') as $key => $value)
        {
            $role = new Role;
            $role->name      = $value;
            $role->created_by= 1;
            $role->updated_by= 1;
            $role->save();
        }
    }

}
