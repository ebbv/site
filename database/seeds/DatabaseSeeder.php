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
        factory(App\Email::class, 10)->create();
        factory(App\Phone::class, 10)->create();
        factory(App\Message::class, 100)->create();

        $users = User::all();

        foreach ($users as $u) {
            $u->assign('phone', array_random(range(1, 10), array_random([1, 2])));
            $u->assign('email', array_random(range(1, 10), array_random([1, 2])));
        }

        foreach (['administrateur', 'membre', 'orateur'] as $key => $name) {
            factory(App\Role::class)
                ->create(['name' => $name])
                ->assignTo(($key == 1) ? $users : $m);
        }
    }
}
