<?php

namespace App\Http\Livewire;

use App\Repositories\TicketRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class Ticket extends Component
{
    public $showForm = false;

    use WithPagination;

    public $users;
//    public $tickets;
    public $updateMode = false;
    public $categories;
    public $ticketId;

    public $title;
    public $targetDate;
    public $urgencyLevel;
    public $categoryId;
    public $subCategoryId;
    public $description;
    public $assignedToId;
    public $userId;
    public $watchUserIds = [];

    public $search = '';

    protected $rules = [
        'title' => 'required',
        'description' => 'required',
        'targetDate' => 'required',
        'urgencyLevel' => 'required',
        'categoryId' => 'required',
        'subCategoryId' => 'required',
        'userId' => 'required'
    ];

    public function render()
    {
        $this->userId = Auth::id();

        $this->users = \App\Models\User::all(); // get project members only based on category

        $this->categories = \App\Models\Category::with('project')
            ->with('subcategories')
            ->get();

        return view('livewire.ticket', [
            'tickets' => \App\Models\Ticket::when(strlen($this->search) > 3, function ($query) {
                return $query->where('title', 'like', '%' . $this->search . '%')
                    ->orWhere('description', 'like', '%' . $this->search . '%');
            })
            ->paginate(10)
        ]);
    }

    public function addWatchUsers($id)
    {
        if (($key = array_search($id, $this->watchUserIds)) !== false) {
            unset($this->watchUserIds[$key]);
        } else {
            array_push($this->watchUserIds, $id);
        }
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
        $request->watchUserIds = $this->watchUserIds;
        $request->assignedToId = $this->assignedToId;

        App::make(TicketRepositoryInterface::class)->store($request);

        $this->showForm = false;

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
        $this->watchUserIds = null;
        $this->assignedToId = null;
        $this->watchUserIds = [];
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

        $involvedTeamMembers = $ticket->invlolvedTeamMembers();

        $this->ticketId = $id;
        $this->title = $ticket->title;
        $this->description = $ticket->description;
        $this->targetDate = Carbon::parse($ticket->target_date)->format('m/d/Y');
        $this->urgencyLevel = $ticket->urgency_level;
        $this->categoryId = $ticket->category_id;
        $this->subCategoryId = $ticket->subcategory_id;
        $this->watchUserIds = $involvedTeamMembers->where('watcher', 1)->count() > 0 ? $involvedTeamMembers->where('watcher', 1)->pluck('id')->toArray() : [];
        $this->assignedToId = $involvedTeamMembers->where('assigned', 1)->first() ? $involvedTeamMembers->where('assigned', 1)->first()->id : null;

        $this->showForm = true;
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
        $request->watchUserIds = $this->watchUserIds;

        $request->assignedToId = $this->assignedToId;

        App::make(TicketRepositoryInterface::class)->update($request);

        $this->updateMode = false;
        $this->categoryId = null;
        $this->showForm = false;

        session()->flash('message', 'Project Updated Successfully.');

        $this->resetForm();
    }
}
