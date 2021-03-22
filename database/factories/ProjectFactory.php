<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Project;

class ProjectFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Project::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $projects = [
            'Ticketing System',
            'CRM',
            'Social Network',
            'MyTeams'
        ];

        return [
            'name' => $projects[rand(0, 3)],
            'description' => $this->faker->text,
        ];
    }
}
