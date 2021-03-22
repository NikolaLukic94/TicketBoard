<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Comment extends Component
{
    public $ticket;
    public $comment;
    public $userId;
    public $ticketId;

    protected $rules = [
        'comment' => 'required',
        'ticketId' => 'required',
        'userId' => 'required',
    ];

    public function mount(\App\Models\Ticket $ticket) {
        $this->ticket = $ticket;
    }

    public function render()
    {
        $userId = Auth::id();
        $ticketId = $this->ticket->id;

        return view('livewire.comment', [
            'comments' => \App\Models\Comment::where('ticket_id', $ticketId)->get()
        ]);
    }

    public function submitForm()
    {
        $this->validate();

        \App\Models\Comment::create([
            'ticket_id' => $this->ticketId,
            'content' => $this->comment,
            'user_id' => $this->userId
        ]);

        $this->comment = '';
    }
}
