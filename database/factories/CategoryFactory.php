<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Category;
use App\Models\Project;

class CategoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Category::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $categories = [
            'pending',
            'in progress',
            'testing',
            'completed',
            'pushed',
            'deployed'
        ];

        return [
            'name' => $categories[rand(0, 5)],
            'project_id' => Project::first()->id //Project::factory(),
        ];
    }
}
