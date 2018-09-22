<?php

use App\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $m = factory('App\User')->create([
            'first_name'=> 'Robert',
            'last_name' => 'Doucette',
            'username'  => 'pasteur',
            'password'  => Hash::make(env('DB_PASSWORD'))
        ]);

        foreach (['administrateur', 'membre', 'orateur'] as $name) {
            factory('App\Role')->create(['name' => $name]);
        }

        foreach ([1, 3] as $r) {
            $m->roles()->attach($r, [
                'created_by' => 1,
                'updated_by' => 1
            ]);
        }

        factory('App\Address')->create([
            'user_id'       => $m->id,
            'street_number' => 58,
            'street_name'   => 'du Vieux Château',
            'city'          => 'Vernon'
        ]);

        factory('App\Message', 40)->create();

        foreach (User::all() as $user) {
            $user->roles()->attach(2, [
                'created_by' => 1,
                'updated_by' => 1
            ]);

            factory('App\Email')->create(['user_id' => $user->id]);
            factory('App\Phone')->create(['user_id' => $user->id]);
        }
    }
}
