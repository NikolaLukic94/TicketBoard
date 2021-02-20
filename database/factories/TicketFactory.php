<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Project;
use App\Models\Ticket;
use App\Models\User;

class TicketFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Ticket::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'target_date' => $this->faker->date(),
            'title' => $this->faker->sentence(4),
            'description' => $this->faker->text,
            'uuid' => $this->faker->sentence(4),
            'urgency_level' => $this->faker->word,
            'author_id' => User::factory(),
            'category_id' => Category::factory(),
            'subcategory_id' => Subcategory::factory(),
        ];
    }
}
