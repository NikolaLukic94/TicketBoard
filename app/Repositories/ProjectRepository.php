<?php

namespace App\Repositories;

use App\Models\Project;

class ProjectRepository implements ProjectRepositoryInterface
{
    public function store($name, $description, $projectMemberIds)
    {
        Project::create([
            'name' => $name,
            'description' => $description
        ]);
\Log::info($projectMemberIds);

    }

    public function update($id, $name, $description)
    {
        $project = Project::find($id);

        $project->update([
            'name' => $name,
            'description' => $description,
        ]);
    }

    public function delete($id)
    {
        Project::find($id)->delete();
    }
}
