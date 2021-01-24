<?php

namespace App\Repositories;

use App\Models\Subcategory;

class SubcategoryRepository implements SubcategoryRepositoryIterface
{
    public function store($name, $projectId)
    {
        Subcategory::create([
            'name' => $name,
            'category_id' => $projectId
        ]);
    }

    public function update($id, $name, $projectId)
    {
        $subcategory = Subcategory::find($id);

        $subcategory->update([
            'name' => $name,
            'category_id' => $projectId,
        ]);
    }

    public function delete($id)
    {
        Subcategory::find($id)->delete();
    }
}
