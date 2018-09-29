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

        foreach (['administrateur', 'membre', 'orateur'] as $name) {
            factory(App\Role::class)->create(['name' => $name]);
        }

        foreach ([1, 2, 3] as $r) {
            $m->roles()->attach($r, [
                'created_by' => 1,
                'updated_by' => 1
            ]);
        }

        factory(App\Address::class)->create(['user_id' => $m->id]);
        factory(App\Email::class)->create(['user_id' => $m->id]);
        factory(App\Phone::class)->create(['user_id' => $m->id]);

        factory(App\Message::class, 100)->create();
    }
}
