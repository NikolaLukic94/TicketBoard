<?php

namespace App\Http\Livewire;

use App\Repositories\CategoryRepositoryInterface;
use Illuminate\Support\Facades\App;
use Livewire\Component;
use Livewire\WithPagination;

class Category extends Component
{
    use WithPagination;

    public $showForm = false;

    public $search = '';

    public $categoryId;
    public $name;
    public $projectId;
    public $updateMode = false;
    public $projects;

    protected $rules = [
        'name' => 'required',
        'projectId' => 'required',
    ];

    public function render()
    {
        $this->projects = \App\Models\Project::all();

        return view('livewire.category', [
            'categories' =>  \App\Models\Category::with('project')
                ->when(strlen($this->search) > 3, function ($query) {
                    return $query->where('name', 'like', '%' . $this->search . '%');
                })
                ->paginate(10)
        ]);
    }

    public function submitForm()
    {
        $this->showForm = false;

        $this->validate();

        App::make(CategoryRepositoryInterface::class)->store($this->name, $this->projectId);
    }

    public function update()
    {
        App::make(CategoryRepositoryInterface::class)->update(
            $this->categoryId, $this->name, $this->projectId
        );

        $this->updateMode = false;
        $this->categoryId = null;
        $this->showForm = false;

        session()->flash('message', 'Project Updated Successfully.');

        $this->resetForm();
    }

    private function resetForm()
    {
        $this->name = '';
        $this->projectId = '';
    }

    public function edit($id)
    {
        $this->showForm = true;
        $this->updateMode = true;

        $category = \App\Models\Category::find($id);

        $this->categoryId = $id;
        $this->name = $category->name;
        $this->projectId = $category->project_id;
    }

    public function delete($id)
    {
        if($id){
            App::make(CategoryRepositoryInterface::class)->delete($id);

            session()->flash('message', 'Users Deleted Successfully.');
        }
    }

    public function cancel()
    {
        $this->updateMode = false;
        $this->resetForm();
    }
}
