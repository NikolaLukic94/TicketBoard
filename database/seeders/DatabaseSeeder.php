<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Label;
use App\Models\Project;
use App\Models\Subcategory;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Project::factory()->count(4)->create();
        Label::factory()->count(5)->create();
        Category::factory()->count(3)->create();
        Subcategory::factory()->count(4)->create();
        Ticket::factory()->count(10)->create();
    }
}
