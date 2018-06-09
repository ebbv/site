<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public function setUp()
    {
        parent::setUp();
        $this->withoutExceptionHandling();
    }

    protected function signIn($user = null)
    {
        $user = $user ?: factory('App\User')->make();
        $this->actingAs($user);
        return $this;
    }

    protected function signInAdmin()
    {
        $user = factory('App\User')->create();
        $role = factory('App\Role')->create(['name' => 'administrateur']);
        $user->roles()->attach(1, [
            'created_by' => 1,
            'updated_by' => 1
        ]);
        $this->actingAs($user);
        return $this;
    }
}
