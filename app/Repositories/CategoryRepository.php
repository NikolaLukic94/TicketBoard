<?php

namespace App\Repositories;

use App\Models\Category;
use App\Models\Project;

class CategoryRepository implements CategoryRepositoryInterface
{
    public function store($name, $projectId)
    {
        Category::create([
            'name' => $name,
            'project_id' => $projectId
        ]);
    }

    public function update($id, $name, $projectId)
    {
        $project = Category::find($id);

        $project->update([
            'name' => $name,
            'project_id' => $projectId,
        ]);
    }

    public function delete($id)
    {
        Category::find($id)->delete();
    }
}
