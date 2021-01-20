<?php

namespace Database\Seeders;

use App\Models\TicketUser;
use Illuminate\Database\Seeder;

class TicketUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TicketUser::factory()->count(5)->create();
    }
}
