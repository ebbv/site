<?php

class MemberRoleTableSeeder extends Seeder {

    public function run()
    {
        $info = array(
            array(
                'id'    => 1,
                'role'  => 1
            ),
            array(
                'id'    => 1,
                'role'  => 2
            ),
            array(
                'id'    => 1,
                'role'  => 3
            ),
            array(
                'id'    => 2,
                'role'  => 3
            )
        );
        foreach($info as $key => $value)
        {
            DB::table('member_role')->insert(array(
                'member_id' => $value['id'],
                'role_id'   => $value['role'],
                'created_by'=> 1,
                'updated_by'=> 1,
                'created_at'=> date('Y-m-d H:i:s'),
                'updated_at'=> date('Y-m-d H:i:s')
            ));
        }
    }

}
