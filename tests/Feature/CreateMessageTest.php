<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreateMessageTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function unauthorized_users_may_not_create_messages()
    {
        $this->withExceptionHandling();

        // guests
        $this->get('message/'.__('nav.actions.add'))
            ->assertRedirect(route('login'));

        $this->post('message')
            ->assertRedirect(route('login'));

        // signed in user without the proper credentials
        $this->signIn();
        $this->get('message/'.__('nav.actions.add'))
            ->assertStatus(403);
    }

    /** @test */
    public function an_authorized_user_can_create_messages()
    {
        $this->signInAdmin();

        $message = factory('App\Message')->create();

        $this->post('message', $message->toArray());

        $this->get($message->path())
            ->assertSee($message->title);
    }

    /** @test */
    public function a_message_requires_a_valid_user_id()
    {
        $this->signInAdmin();

        $this->publishMessage(['user_id' => null])
            ->assertSessionHasErrors('user_id');

        $this->publishMessage(['user_id' => 999])
            ->assertSessionHasErrors('user_id');
    }

    /** @test */
    public function a_message_requires_a_title()
    {
        $this->signInAdmin();

        $this->publishMessage(['title' => null])
            ->assertSessionHasErrors('title');
    }

    /** @test */
    public function a_message_requires_a_passage()
    {
        $this->signInAdmin();

        $this->publishMessage(['passage' => null])
            ->assertSessionHasErrors('passage');
    }

    public function publishMessage($overrides = [])
    {
        $this->withExceptionHandling();

        $message = factory('App\Message')->make($overrides);

        return $this->post('message', $message->toArray());
    }
}