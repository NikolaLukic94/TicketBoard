<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Category;
use App\Models\Project;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\CategoryController
 */
class CategoryControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $categories = Category::factory()->count(3)->create();

        $response = $this->get(route('category.index'));

        $response->assertOk();
        $response->assertViewIs('category.index');
        $response->assertViewHas('categories');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\CategoryController::class,
            'store',
            \App\Http\Requests\CategoryStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $name = $this->faker->name;
        $project = Project::factory()->create();

        $response = $this->post(route('category.store'), [
            'name' => $name,
            'project_id' => $project->id,
        ]);

        $categories = Category::query()
            ->where('name', $name)
            ->where('project_id', $project->id)
            ->get();
        $this->assertCount(1, $categories);
        $category = $categories->first();

        $response->assertRedirect(route('category.index'));
        $response->assertSessionHas('category.id', $category->id);
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\CategoryController::class,
            'update',
            \App\Http\Requests\CategoryUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $category = Category::factory()->create();
        $name = $this->faker->name;
        $project = Project::factory()->create();

        $response = $this->put(route('category.update', $category), [
            'name' => $name,
            'project_id' => $project->id,
        ]);

        $category->refresh();

        $response->assertRedirect(route('category.index'));
        $response->assertSessionHas('category.id', $category->id);

        $this->assertEquals($name, $category->name);
        $this->assertEquals($project->id, $category->project_id);
    }
}
