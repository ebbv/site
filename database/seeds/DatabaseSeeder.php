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
        foreach (['administrateur', 'membre', 'orateur'] as $name) {
            factory(App\Role::class)->create(['name' => $name]);
        }

        factory(User::class)->create([
            'first_name'=> 'Robert',
            'last_name' => 'Doucette',
            'username'  => 'pasteur',
            'password'  => Hash::make(env('DB_PASSWORD'))
        ])->assignRoles([1, 3]);

        factory(App\Address::class, 5)->create();
        factory(App\Email::class)->create(['user_id' => 1]);
        factory(App\Phone::class)->create(['user_id' => 1]);
        factory(App\Message::class, 100)->create();
    }
}
