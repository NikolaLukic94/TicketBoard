<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Board extends Component
{
    public $projectData;

    public $theid;

    public function mount($theid)
    {
        $this->projectData = \App\Models\Project::with('members')->with(['categories.tickets' => function ($query) {
            $query->with('author')
                ->with('subcategory');
        }])->where('id', $theid)->first();

        return view('livewire.board');
    }

//    public function render()
//    {
//        $this->tickets = \App\Models\Ticket::with('author')
//            ->with('category.project')
//            ->with('subcategory')
//            ->with('invlolvedTeamMembers')
//            ->get();
//
//        return view('livewire.board');
//    }
}
