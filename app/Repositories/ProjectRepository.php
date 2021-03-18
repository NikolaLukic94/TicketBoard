<?php

namespace App\Repositories;

use App\Models\Project;
use Illuminate\Support\Facades\DB;

class ProjectRepository implements ProjectRepositoryInterface
{
    public function store($name, $description, $projectMemberIds)
    {
        $project = Project::create([
            'name' => $name,
            'description' => $description
        ]);

        $project->members()->detach();

        $project->members()->attach($projectMemberIds);
    }

    public function update($id, $name, $description, $projectMemberIds)
    {
        $project = Project::find($id);

        $project->update([
            'name' => $name,
            'description' => $description,
        ]);

        $project->members()->detach();

        $project->members()->attach($projectMemberIds);
    }

    public function delete($id)
    {
        Project::find($id)->delete();
    }
}
