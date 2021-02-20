<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Label;
use App\Models\Project;
use App\Models\Subcategory;
use App\Models\Ticket;
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
        Project::factory()->count(5)->create();
        Label::factory()->count(5)->create();
        Category::factory()->count(5)->create();
        Subcategory::factory()->count(5)->create();
        Ticket::factory()->count(5)->create();
    }
}
