<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Label;
use App\Models\Project;
use App\Models\Subcategory;
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
        Project::factory()->create();
        Label::factory()->create();
        Category::factory()->create();
        Subcategory::factory()->create();
    }
}
