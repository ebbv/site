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
        $m = factory(User::class)->create([
            'first_name'=> 'Robert',
            'last_name' => 'Doucette',
            'username'  => 'pasteur',
            'password'  => Hash::make(env('DB_PASSWORD'))
        ]);

        factory(App\Address::class, 5)->create();
        factory(App\Email::class)->create(['user_id' => $m->id]);
        factory(App\Phone::class)->create(['user_id' => $m->id]);

        foreach (['administrateur', 'membre', 'orateur'] as $name) {
            factory(App\Role::class)->create(['name' => $name]);
        }

        foreach ([1, 3] as $r) {
            $m->roles()->attach($r, [
                'created_by' => 1,
                'updated_by' => 1
            ]);
        }

        factory(App\Message::class, 100)->create();

        foreach (User::all() as $u) {
            $u->roles()->attach(2, [
                'created_by' => 1,
                'updated_by' => 1
            ]);
        }
    }
}
