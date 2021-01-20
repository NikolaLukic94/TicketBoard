<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Ticket;
use App\Models\TicketUser;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\TicketUserController
 */
class TicketUserControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $ticketUsers = TicketUser::factory()->count(3)->create();

        $response = $this->get(route('ticket-user.index'));

        $response->assertOk();
        $response->assertViewIs('ticketUser.index');
        $response->assertViewHas('ticketUsers');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\TicketUserController::class,
            'store',
            \App\Http\Requests\TicketUserStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $ticket = Ticket::factory()->create();
        $user = User::factory()->create();
        $watcher = $this->faker->boolean;
        $assigned = $this->faker->boolean;

        $response = $this->post(route('ticket-user.store'), [
            'ticket_id' => $ticket->id,
            'user_id' => $user->id,
            'watcher' => $watcher,
            'assigned' => $assigned,
        ]);

        $ticketUsers = TicketUser::query()
            ->where('ticket_id', $ticket->id)
            ->where('user_id', $user->id)
            ->where('watcher', $watcher)
            ->where('assigned', $assigned)
            ->get();
        $this->assertCount(1, $ticketUsers);
        $ticketUser = $ticketUsers->first();

        $response->assertRedirect(route('ticketUser.index'));
        $response->assertSessionHas('ticketUser.id', $ticketUser->id);
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\TicketUserController::class,
            'update',
            \App\Http\Requests\TicketUserUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $ticketUser = TicketUser::factory()->create();
        $ticket = Ticket::factory()->create();
        $user = User::factory()->create();
        $watcher = $this->faker->boolean;
        $assigned = $this->faker->boolean;

        $response = $this->put(route('ticket-user.update', $ticketUser), [
            'ticket_id' => $ticket->id,
            'user_id' => $user->id,
            'watcher' => $watcher,
            'assigned' => $assigned,
        ]);

        $ticketUser->refresh();

        $response->assertRedirect(route('ticketUser.index'));
        $response->assertSessionHas('ticketUser.id', $ticketUser->id);

        $this->assertEquals($ticket->id, $ticketUser->ticket_id);
        $this->assertEquals($user->id, $ticketUser->user_id);
        $this->assertEquals($watcher, $ticketUser->watcher);
        $this->assertEquals($assigned, $ticketUser->assigned);
    }
}
