<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MessageTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_has_a_speaker()
    {
        $message = factory('App\Message')->create([
            'user_id' => factory('App\User')->create()->id
        ]);

        $this->assertInstanceOf('App\User', $message->speaker);
    }
}
