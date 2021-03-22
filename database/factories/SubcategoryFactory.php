<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Category;
use App\Models\Subcategory;

class SubcategoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Subcategory::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $subcategories = [
            'bug',
            'feature',
            'upgrade',
            'change'
        ];

        return [
            'name' => $subcategories[rand(0, 3)],
            'category_id' => Category::find(rand(1, Category::count()))->id,
        ];
    }
}
