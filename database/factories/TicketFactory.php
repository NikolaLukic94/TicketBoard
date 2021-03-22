<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Database\Eloquent\Factories\Factory;
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
        $titles = [
            'Auth broken v1',
            'Visuals broken v1',
            'Layout fix v1',
            'Module improvements v1',
            'Optimisation v1',
            'Support Levels v1',
            'Internal Customers v1',
            'Auth broken v2',
            'Visuals broken v2',
            'Layout fix v2',
            'Module improvements v2',
            'Optimisation v2',
            'Support Levels v2',
            'Internal Customers v2',
        ];

        $urgencies = [
            'low',
            'medium',
            'high'
        ];

        return [
            'target_date' => $this->faker->date(),
            'title' => $titles[rand(0, 13)],
            'description' => $this->faker->text,
            'uuid' => $this->faker->sentence(4),
            'urgency_level' => $urgencies[rand(0, 2)],
            'author_id' => User::factory(),
            'category_id' => Category::find(rand(1, Category::count()))->id,
            'subcategory_id' => Subcategory::find(rand(1, Subcategory::count()))->id,
        ];
    }
}
