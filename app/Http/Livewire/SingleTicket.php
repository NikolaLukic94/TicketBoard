<?php

namespace App\Http\Livewire;

use Livewire\Component;

class SingleTicket extends Component
{
    public $theid;
    public $theTicket;

    public function mount($theid)
    {
        $this->theTicket = \App\Models\Ticket::where('id', $theid)->first();

        return view('livewire.board');
    }

    public function render()
    {
        return view('livewire.single-ticket');
    }
}
