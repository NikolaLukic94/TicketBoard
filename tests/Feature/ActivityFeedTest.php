<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;c
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ActivityFeedTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function creating_a_project_generates_activity()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
