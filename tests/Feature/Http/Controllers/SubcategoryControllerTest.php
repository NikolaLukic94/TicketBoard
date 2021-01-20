<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\SubcategoryController
 */
class SubcategoryControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $subcategories = Subcategory::factory()->count(3)->create();

        $response = $this->get(route('subcategory.index'));

        $response->assertOk();
        $response->assertViewIs('subcategory.index');
        $response->assertViewHas('subcategories');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\SubcategoryController::class,
            'store',
            \App\Http\Requests\SubcategoryStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $name = $this->faker->name;
        $category = Category::factory()->create();

        $response = $this->post(route('subcategory.store'), [
            'name' => $name,
            'category_id' => $category->id,
        ]);

        $subcategories = Subcategory::query()
            ->where('name', $name)
            ->where('category_id', $category->id)
            ->get();
        $this->assertCount(1, $subcategories);
        $subcategory = $subcategories->first();

        $response->assertRedirect(route('subcategory.index'));
        $response->assertSessionHas('subcategory.id', $subcategory->id);
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\SubcategoryController::class,
            'update',
            \App\Http\Requests\SubcategoryUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $subcategory = Subcategory::factory()->create();
        $name = $this->faker->name;
        $category = Category::factory()->create();

        $response = $this->put(route('subcategory.update', $subcategory), [
            'name' => $name,
            'category_id' => $category->id,
        ]);

        $subcategory->refresh();

        $response->assertRedirect(route('subcategory.index'));
        $response->assertSessionHas('subcategory.id', $subcategory->id);

        $this->assertEquals($name, $subcategory->name);
        $this->assertEquals($category->id, $subcategory->category_id);
    }
}
