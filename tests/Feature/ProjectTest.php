<?php

namespace Tests\Feature;

use App\Models\Category;
use Illuminate\Contracts\Auth\Authenticatable;
use App\Http\Livewire\Project;
use JMac\Testing\Traits\AdditionalAssertions;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class ProjectTest extends TestCase
{

    /** @test */
    public function project_page_contains_project_livewire_component()
    {
        $user = \App\Models\User::factory()->create();

        $this->actingAs($user)
            ->get('project')
            ->assertSuccessful()
            ->assertSeeLivewire('project');
    }

    /** @test */
    public function name_is_required()
    {
        Livewire::test(Project::class)
            ->set('description', 'Test test test')
            ->call('store')
            ->assertHasErrors(['name' => 'required']);
    }

    /** @test */
    public function description_is_required()
    {
        Livewire::test(Project::class)
            ->set('name', 'Test test test')
            ->call('store')
            ->assertHasErrors(['description' => 'required']);
    }

    /** @test */
    public function can_have_members()
    {

    }

    /** @test */
    public function has_many_categories_with_parent_id_fk()
    {
        $project = \App\Models\Project::factory()->create();
        $category = Category::factory()->create(['project_id' => $project]);;

        $this->assertTrue($project->categories->contains($category));

        $this->assertEquals(1, $project->categories->count());

        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $project->categories);
    }
}
