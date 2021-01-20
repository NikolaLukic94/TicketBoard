<?php

namespace Database\Factories;

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
            'urgency_level' => $this->faker->word,
            'author_id' => User::factory(),
            'project_id' => Project::factory(),
        ];
    }
}
