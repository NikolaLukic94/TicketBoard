<?php

namespace App\Http\Livewire;

use App\Repositories\TicketRepositoryInterface;
use Illuminate\Support\Facades\App;
use Livewire\Component;

class Ticket extends Component
{
    public $users;
    public $tickets;
    public $updateMode = false;
    public $categories;
    public $ticketId;

    public $title;
    public $description;
    public $targetDate;
    public $urgencyLevel;
    public $categoryId;
    public $subCategoryId;

    protected $rules = [
        'title' => 'required',
        'description' => 'required',
        'targetDate' => 'required',
        'urgencyLevel' => 'required',
        'categoryId' => 'required',
        'subCategoryId' => 'required',
    ];

    public function render()
    {
        $this->users = \App\Models\User::all(); // get project members only
        $this->tickets = \App\Models\Ticket::all();
        $this->categories = \App\Models\Category::with('project')->with('subcategories')->get();

        return view('livewire.ticket');
    }

    public function submitForm()
    {
        $this->validate();

        $request = new \stdClass();
        $request->title = $this->title;
        $request->description = $this->description;
        $request->targetDate = $this->targetDate;
        $request->urgencyLevel = $this->urgencyLevel;
        $request->categoryId = $this->categoryId;
        $request->subCategoryId = $this->subCategoryId;

        App::make(TicketRepositoryInterface::class)->store($request);

        session()->flash('message', 'Ticket Created Successfully.');

        $this->resetForm();
    }

    public function resetForm()
    {
        $this->title = null;
        $this->description = null;
        $this->targetDate = null;
        $this->urgencyLevel = null;
        $this->categoryId = null;
        $this->subCategoryId = null;
    }

    public function delete($id)
    {
        if($id){
            App::make(TicketRepositoryInterface::class)->delete($id);

            session()->flash('message', 'Ticket Deleted Successfully.');
        }
    }

    public function edit($id)
    {
        $this->updateMode = true;
        $ticket = \App\Models\Ticket::find($id);

        $this->ticketId = $id;
        $this->title = $ticket->title;
        $this->description = $ticket->description;
        $this->targetDate = $ticket->targetDate;
        $this->urgencyLevel = $ticket->urgencyLevel;
        $this->categoryId = $ticket->categoryId;
        $this->subCategoryId = $ticket->subCategoryId;
    }

    public function update()
    {
        $request = new \stdClass();
        $request->id = $this->ticketId;
        $request->title = $this->title;
        $request->description = $this->description;
        $request->targetDate = $this->targetDate;
        $request->urgencyLevel = $this->urgencyLevel;
        $request->categoryId = $this->categoryId;
        $request->subCategoryId = $this->subCategoryId;

        App::make(TicketRepositoryInterface::class)->update($request);

        $this->updateMode = false;
        $this->categoryId = null;

        session()->flash('message', 'Project Updated Successfully.');

        $this->resetForm();
    }
}
