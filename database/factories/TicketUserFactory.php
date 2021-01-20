<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Ticket;
use App\Models\TicketUser;
use App\Models\User;

class TicketUserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = TicketUser::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'ticket_id' => Ticket::factory(),
            'user_id' => User::factory(),
            'watcher' => $this->faker->boolean,
            'assigned' => $this->faker->boolean,
        ];
    }
}
