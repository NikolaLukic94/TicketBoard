<?php

namespace App\Http\Livewire;

use App\Repositories\ProjectRepositoryInterface;
use Illuminate\Support\Facades\App;
use Livewire\Component;
use Livewire\WithPagination;

class Project extends Component
{
    use WithPagination;

    public $showForm = false;

    public $projectMembers = [];
    public $users;
    public $description;
    public $project_id;
    public $name;

    public $search = '';

    public $updateMode = false;

    protected $rules = [
        'name' => 'required',
        'description' => 'required',
    ];

    public function render()
    {
        $this->users = \App\Models\User::all();

        return view('livewire.project', [
            'projects' => \App\Models\Project::when(strlen($this->search) > 3, function ($query) {
                return $query->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('description', 'like', '%' . $this->search . '%');
            })->paginate(10)
        ]);
    }


    public function submitForm()
    {
        $this->validate();

        App::make(ProjectRepositoryInterface::class)->store(
            $this->name, $this->description, $this->projectMembers
        );

        $this->showForm = false;

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
        $this->showForm = true;

        $project = \App\Models\Project::find($id);

        $this->project_id = $project->id;
        $this->name = $project->name;
        $this->description = $project->description;
        $this->projectMembers = $project->members->pluck('id')->toArray();
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
                $this->project_id, $this->name, $this->description, $this->projectMembers
            );

            $this->updateMode = false;
            $this->showForm = false;

            session()->flash('message', 'Project Updated Successfully.');

            $this->resetForm();
        }
    }

    public function delete($id)
    {
        if ($id) {
            App::make(ProjectRepositoryInterface::class)->delete($id);

            session()->flash('message', 'Users Deleted Successfully.');
        }
    }
}
