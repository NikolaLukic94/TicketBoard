<?php

namespace Tests\Feature;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class TicketTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function ticket_page_contains_ticket_livewire_component()
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->get('ticket')
            ->assertSuccessful()
            ->assertSeeLivewire('ticket');
    }

    /** @test */
    public function target_date_is_required()
    {
        $user = \App\Models\User::factory()->create();

        $category = \App\Models\Category::factory()->create();
        $subcategory = \App\Models\Subcategory::factory()->create();

        Livewire::test(\App\Http\Livewire\Ticket::class)
            ->set('title', 'Ticket test title')
            ->set('description', 'Ticket test desc')
            ->set('urgencyLevel', 'low')
            ->set('categoryId', $category->id)
            ->set('subCategoryId', $subcategory->id)
            ->set('assignedToId', $user->id)
            ->call('submitForm')
            ->assertHasErrors(['targetDate' => 'required']);
    }

    /** @test */
    public function title_is_generated_upon_creation()
    {
        $user = \App\Models\User::factory()->create();

        $category = \App\Models\Category::factory()->create();
        $subcategory = \App\Models\Subcategory::factory()->create();

        Livewire::test(\App\Http\Livewire\Ticket::class)
            ->set('description', 'Ticket test desc')
            ->set('targetDate', Carbon::now()->format('Y-m-d'))
            ->set('urgencyLevel', 'low')
            ->set('categoryId', $category->id)
            ->set('subCategoryId', $subcategory->id)
            ->set('assignedToId', $user->id)
            ->call('submitForm')
            ->assertHasErrors(['title' => 'required']);
    }

    /** @test */
    public function description_is_required()
    {
        $user = \App\Models\User::factory()->create();

        $category = \App\Models\Category::factory()->create();
        $subcategory = \App\Models\Subcategory::factory()->create();

        Livewire::test(\App\Http\Livewire\Ticket::class)
            ->set('title', 'Ticket test title')
            ->set('targetDate', Carbon::now()->format('Y-m-d'))
            ->set('urgencyLevel', 'low')
            ->set('categoryId', $category->id)
            ->set('subCategoryId', $subcategory->id)
            ->set('assignedToId', $user->id)
            ->call('submitForm')
            ->assertHasErrors(['description' => 'required']);
    }

    /** @test */
    public function author_is_required()
    {
        $user = \App\Models\User::factory()->create();

        $category = \App\Models\Category::factory()->create();
        $subcategory = \App\Models\Subcategory::factory()->create();

        Livewire::test(\App\Http\Livewire\Ticket::class)
            ->set('title', 'Ticket test title')
            ->set('description', 'Ticket test desc')
            ->set('targetDate', Carbon::now()->format('Y-m-d'))
            ->set('urgencyLevel', 'low')
            ->set('categoryId', $category->id)
            ->set('subCategoryId', $subcategory->id)
            ->call('submitForm')
            ->assertHasErrors(['userId' => 'required']);
    }

    /** @test */
    public function category_is_required()
    {
        $user = \App\Models\User::factory()->create();

        $subcategory = \App\Models\Subcategory::factory()->create();

        Livewire::test(\App\Http\Livewire\Ticket::class)
            ->set('title', 'Ticket test title')
            ->set('description', 'Ticket test desc')
            ->set('targetDate', Carbon::now()->format('Y-m-d'))
            ->set('urgencyLevel', 'low')
            ->set('subCategoryId', $subcategory->id)
            ->set('assignedToId', $user->id)
            ->call('submitForm')
            ->assertHasErrors(['categoryId' => 'required']);
    }

    /** @test */
    public function subcategory_is_required()
    {
        $user = \App\Models\User::factory()->create();

        $category = \App\Models\Category::factory()->create();

        Livewire::test(\App\Http\Livewire\Ticket::class)
            ->set('title', 'Ticket test title')
            ->set('description', 'Ticket test desc')
            ->set('targetDate', Carbon::now()->format('Y-m-d'))
            ->set('urgencyLevel', 'low')
            ->set('categoryId', $category->id)
            ->set('assignedToId', $user->id)
            ->call('submitForm')
            ->assertHasErrors(['subCategoryId' => 'required']);
    }
}
