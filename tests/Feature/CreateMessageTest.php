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
        // guests
        $this->get(route('messages.create'))
            ->assertRedirect(route('login'));

        $this->post(route('messages.store'))
            ->assertRedirect(route('login'));

        // signed in user without the proper credentials
        $this->signIn();
        $this->get(route('messages.create'))
            ->assertStatus(403);
    }

    /** @test */
    public function an_authorized_user_can_create_messages()
    {
        $this->signInAdmin();

        $title = 'Some title';

        $this->publishMessage([
            'title'   => $title,
            'user_id' => auth()->user()->id
        ]);

        $this->assertDatabaseHas('messages', ['title' => $title]);
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

    /** @test */
    public function a_message_requires_a_date()
    {
        $this->signInAdmin();

        $this->publishMessage(['date' => null])
            ->assertSessionHasErrors('date');
    }

    protected function publishMessage($overrides = [])
    {
        $message = factory('App\Message')->raw($overrides);

        return $this->post(route('messages.store'), $message);
    }
}
