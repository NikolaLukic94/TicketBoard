<?php

namespace App\Http\Controllers;

use App\Models\Ticket;

class TicketController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('ticket.index');
    }

    public function board($id)
    {
        $theid = $id;

        return view('ticket.board', compact('theid'));
    }

    public function show(Ticket $ticket)
    {
        $theid = $ticket->id;

        return view('ticket.show', compact('theid'));
    }
}
