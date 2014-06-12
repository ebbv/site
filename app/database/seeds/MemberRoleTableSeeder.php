<?php

class MemberRoleTableSeeder extends Seeder {

    public function run()
    {
        DB::table('member_role')->insert(array(
            array(
                'member_id' => 1,
                'role_id'   => 1,
                'created_by'=> 1,
                'updated_by'=> 1,
                'created_at'=> date('Y-m-d H:i:s'),
                'updated_at'=> date('Y-m-d H:i:s')
            ),
            array(
                'member_id' => 1,
                'role_id'   => 2,
                'created_by'=> 1,
                'updated_by'=> 1,
                'created_at'=> date('Y-m-d H:i:s'),
                'updated_at'=> date('Y-m-d H:i:s')
            ),
            array(
                'member_id' => 1,
                'role_id'   => 3,
                'created_by'=> 1,
                'updated_by'=> 1,
                'created_at'=> date('Y-m-d H:i:s'),
                'updated_at'=> date('Y-m-d H:i:s')
            )
        ));
    }

}