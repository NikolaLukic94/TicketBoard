<?php

namespace App\Http\Livewire;

use App\Repositories\ProjectRepositoryInterface;
use Illuminate\Support\Facades\App;
use Livewire\Component;

class Project extends Component
{
    public $projectMembers = [];
    public $projects;
    public $users;
    public $description;
    public $project_id;
    public $name;

    public $updateMode = false;

    protected $rules = [
        'name' => 'required',
        'description' => 'required',
    ];

    public function submitForm()
    {
        $this->validate();

        App::make(ProjectRepositoryInterface::class)->store(
            $this->name, $this->description, $this->projectMembers
        );

        session()->flash('message', 'Project Created Successfully.');

        $this->resetForm();
    }

    public function addProjectMembers($id)
    {
        if (($key = array_search($id, $this->projectMembers)) !== false) {
            unset($this->projectMembers[$key]);
        } else {
            array_push($this->projectMembers, $id);
        }
    }

    public function edit($id)
    {
        $this->updateMode = true;

        $project = \App\Models\Project::find($id);

        $this->project_id = $project->id;
        $this->name = $project->name;
        $this->description = $project->description;
        $this->projectMembers = $project->members->pluck('id')->toArray();
    }

    public function render()
    {
        $this->projects = \App\Models\Project::all();
        $this->users = \App\Models\User::all();

        return view('livewire.project');
    }

    private function resetForm()
    {
        $this->name = '';
        $this->description = '';
        $this->projectMembers = [];
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
                $this->project_id, $this->name, $this->description,  $this->projectMembers
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
