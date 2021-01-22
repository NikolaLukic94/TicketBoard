<?php

namespace Database\Seeders;

use App\Models\Label;
use App\Models\Project;
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

        foreach (Project::all() as $project) {
            Label::factory()->create(['project_id' => $project->id]);
        }
    }
}
