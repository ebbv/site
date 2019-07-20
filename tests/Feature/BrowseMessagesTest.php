<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BrowseMessagesTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $this->message = factory('App\Message')->create([
            'user_id' => factory('App\User')->create()->id
        ]);
    }

    /** @test */
    public function a_user_can_browse_messages()
    {
        $this->get('messages')
            ->assertSee($this->message->title);
    }

    /** @test */
    public function a_user_can_browse_to_a_specific_message()
    {
        $this->get($this->message->path())
            ->assertSee($this->message->title);
    }

    /**@test */
    public function a_user_can_see_the_speaker_associated_with_a_message()
    {
        $this->get($this->message->path())
            ->assertSee($this->message->speaker);
    }
}
