<?php

namespace Database\Seeders;

use App\Models\Label;
use App\Models\Project;
use Illuminate\Database\Seeder;

class LabelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $newProject = Project::first();

        Label::create([
            'project_id' => $newProject->id,
            'name' => 'Backlog'
        ]);

        Label::create([
            'project_id' => $newProject->id,
            'name' => 'Work in Progress'
        ]);

        Label::create([
            'project_id' => $newProject->id,
            'name' => 'Testing'
        ]);

        Label::create([
            'project_id' => $newProject->id,
            'name' => 'Done'
        ]);
    }
}
