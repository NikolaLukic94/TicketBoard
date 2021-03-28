<?php

namespace Tests\Feature;

use App\Http\Livewire\Subcategory;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class SubcategoryTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function category_page_contains_subcategory_livewire_component()
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->get('subcategory')
            ->assertSuccessful()
            ->assertSeeLivewire('subcategory');
    }

    /** @test */
    public function name_is_required()
    {
        \App\Models\Subcategory::factory()->count(5)->create();

        Livewire::test(Subcategory::class)
            ->set('subcategoryId', \App\Models\Subcategory::first()->id)
            ->call('submitForm')
            ->assertHasErrors(['name' => 'required']);
    }

    /** @test */
    public function categoryId_is_required()
    {
        Livewire::test(Subcategory::class)
            ->set('name', 'Test test test')
            ->call('submitForm')
            ->assertHasErrors(['categoryId' => 'required']);
    }
}
