<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Comment;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\CommentController
 */
class CommentControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $comments = Comment::factory()->count(3)->create();

        $response = $this->get(route('comment.index'));

        $response->assertOk();
        $response->assertViewIs('comment.index');
        $response->assertViewHas('comments');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\CommentController::class,
            'store',
            \App\Http\Requests\CommentStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $text = $this->faker->text;
        $user = User::factory()->create();

        $response = $this->post(route('comment.store'), [
            'text' => $text,
            'user_id' => $user->id,
        ]);

        $comments = Comment::query()
            ->where('text', $text)
            ->where('user_id', $user->id)
            ->get();
        $this->assertCount(1, $comments);
        $comment = $comments->first();

        $response->assertRedirect(route('comment.index'));
        $response->assertSessionHas('comment.id', $comment->id);
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\CommentController::class,
            'update',
            \App\Http\Requests\CommentUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $comment = Comment::factory()->create();
        $text = $this->faker->text;
        $user = User::factory()->create();

        $response = $this->put(route('comment.update', $comment), [
            'text' => $text,
            'user_id' => $user->id,
        ]);

        $comment->refresh();

        $response->assertRedirect(route('comment.index'));
        $response->assertSessionHas('comment.id', $comment->id);

        $this->assertEquals($text, $comment->text);
        $this->assertEquals($user->id, $comment->user_id);
    }
}
