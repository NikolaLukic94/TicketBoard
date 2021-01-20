<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Project;
use App\Models\Ticket;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\TicketController
 */
class TicketControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $tickets = Ticket::factory()->count(3)->create();

        $response = $this->get(route('ticket.index'));

        $response->assertOk();
        $response->assertViewIs('ticket.index');
        $response->assertViewHas('tickets');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\TicketController::class,
            'store',
            \App\Http\Requests\TicketStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $target_date = $this->faker->date();
        $title = $this->faker->sentence(4);
        $description = $this->faker->text;
        $urgency_level = $this->faker->word;
        $author = User::factory()->create();
        $project = Project::factory()->create();

        $response = $this->post(route('ticket.store'), [
            'target_date' => $target_date,
            'title' => $title,
            'description' => $description,
            'urgency_level' => $urgency_level,
            'author_id' => $author->id,
            'project_id' => $project->id,
        ]);

        $tickets = Ticket::query()
            ->where('target_date', $target_date)
            ->where('title', $title)
            ->where('description', $description)
            ->where('urgency_level', $urgency_level)
            ->where('author_id', $author->id)
            ->where('project_id', $project->id)
            ->get();
        $this->assertCount(1, $tickets);
        $ticket = $tickets->first();

        $response->assertRedirect(route('ticket.index'));
        $response->assertSessionHas('ticket.id', $ticket->id);
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $ticket = Ticket::factory()->create();

        $response = $this->get(route('ticket.show', $ticket));

        $response->assertOk();
        $response->assertViewIs('ticket.show');
        $response->assertViewHas('ticket');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\TicketController::class,
            'update',
            \App\Http\Requests\TicketUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $ticket = Ticket::factory()->create();
        $target_date = $this->faker->date();
        $title = $this->faker->sentence(4);
        $description = $this->faker->text;
        $urgency_level = $this->faker->word;
        $author = User::factory()->create();
        $project = Project::factory()->create();

        $response = $this->put(route('ticket.update', $ticket), [
            'target_date' => $target_date,
            'title' => $title,
            'description' => $description,
            'urgency_level' => $urgency_level,
            'author_id' => $author->id,
            'project_id' => $project->id,
        ]);

        $ticket->refresh();

        $response->assertRedirect(route('ticket.index'));
        $response->assertSessionHas('ticket.id', $ticket->id);

        $this->assertEquals(Carbon::parse($target_date), $ticket->target_date);
        $this->assertEquals($title, $ticket->title);
        $this->assertEquals($description, $ticket->description);
        $this->assertEquals($urgency_level, $ticket->urgency_level);
        $this->assertEquals($author->id, $ticket->author_id);
        $this->assertEquals($project->id, $ticket->project_id);
    }
}
