<?php

namespace Tests\Feature;

use App\Http\Livewire\Comment;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class CommentTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function single_ticket_page_contains_comment_livewire_component()
    {
        $user = User::factory()->create();

        Ticket::factory()->create();

        $this->actingAs($user)
            ->get('ticket/1')
            ->assertSuccessful()
            ->assertSeeLivewire('comment');
    }

    /** @test */
    public function content_is_required()
    {
        $ticket = Ticket::factory()->create();

        $user = \App\Models\User::factory()->create();

        Livewire::test(Comment::class)
            ->set('ticketId', $ticket->id)
            ->set('userId', $user->id)
            ->call('submitForm')
            ->assertHasErrors(['comment' => 'required']);
    }

    /** @test */
    public function must_have_an_author()
    {
        $ticket = Ticket::factory()->create();
        $user = User::factory()->create();

        Livewire::test(Comment::class)
            ->set('ticketId', $ticket->id)
            ->set('comment', 'Test comment')
            ->call('submitForm')
            ->assertHasErrors(['userId' => 'required']);
    }

    /** @test */
    public function must_belong_to_a_ticket()
    {
        $ticket = Ticket::factory()->create();
        $user = User::factory()->create();

        Livewire::test(Comment::class)
            ->set('comment', 'Test comment')
            ->set('userId', $user->id)
            ->call('submitForm')
            ->assertHasErrors(['ticketId' => 'required']);
    }
}
