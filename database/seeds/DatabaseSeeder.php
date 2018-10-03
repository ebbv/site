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
        factory(App\Message::class, 100)->create();

        foreach (['administrateur', 'membre', 'orateur'] as $key => $name) {
            factory(App\Role::class)
                ->create(['name' => $name])
                ->assignTo(($key == 1) ? User::all() : $m);
        }
    }
}
