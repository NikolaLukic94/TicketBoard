<?php

namespace App\Http\Livewire;

use App\Repositories\ProjectRepositoryInterface;
use Illuminate\Support\Facades\App;
use Livewire\Component;

class Project extends Component
{
    public $projects;
    public $description;
    public $project_id;
    public $name;
    public $updateMode = false;

    protected $rules = [
        'name' => 'required',
        'description' => 'required',
    ];

    public function store()
    {
        $this->validate();

        App::make(ProjectRepositoryInterface::class)->store($this->name, $this->description);

        session()->flash('message', 'Project Created Successfully.');

        $this->resetForm();
    }

    public function edit($id)
    {
        $this->updateMode = true;

        $project = \App\Models\Project::find($id);

        $this->project_id = $id;
        $this->name = $project->name;
        $this->description = $project->description;
    }

    public function render()
    {
        $this->projects = \App\Models\Project::all();

        return view('livewire.project');
    }

    private function resetForm()
    {
        $this->name = '';
        $this->description = '';
    }

    public function cancel()
    {
        $this->updateMode = false;
        $this->resetForm();
    }

    public function update()
    {
        if ($this->project_id) {
            App::make(ProjectRepositoryInterface::class)->update(
                $this->project_id, $this->name, $this->description
            );

            $this->updateMode = false;

            session()->flash('message', 'Project Updated Successfully.');

            $this->resetForm();
        }
    }

    public function delete($id)
    {
        if($id){
            App::make(ProjectRepositoryInterface::class)->delete($id);

            session()->flash('message', 'Users Deleted Successfully.');
        }
    }
}
