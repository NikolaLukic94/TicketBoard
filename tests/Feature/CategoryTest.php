<?php

namespace Tests\Feature;

use App\Http\Livewire\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    /** @test */
    public function category_page_contains_category_livewire_component()
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->get('category')
            ->assertSuccessful()
            ->assertSeeLivewire('category');
    }

    /** @test */
    public function name_is_required()
    {
        Livewire::test(Category::class)
            ->set('projectId', 2)
            ->call('submitForm')
            ->assertHasErrors(['name' => 'required']);
    }

    /** @test */
    public function project_id_is_required()
    {
        Livewire::test(Category::class)
            ->set('name', 'Test test test')
            ->call('submitForm')
            ->assertHasErrors(['projectId' => 'required']);
    }
}
