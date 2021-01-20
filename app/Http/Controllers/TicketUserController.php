<?php

namespace App\Http\Controllers;

use App\Http\Requests\TicketUserStoreRequest;
use App\Http\Requests\TicketUserUpdateRequest;
use App\Models\TicketUser;
use Illuminate\Http\Request;

class TicketUserController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $ticketUsers = TicketUser::all();

        return view('ticketUser.index', compact('ticketUsers'));
    }

    /**
     * @param \App\Http\Requests\TicketUserStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(TicketUserStoreRequest $request)
    {
        $ticketUser = TicketUser::create($request->validated());

        $request->session()->flash('ticketUser.id', $ticketUser->id);

        return redirect()->route('ticketUser.index');
    }

    /**
     * @param \App\Http\Requests\TicketUserUpdateRequest $request
     * @param \App\Models\TicketUser $ticketUser
     * @return \Illuminate\Http\Response
     */
    public function update(TicketUserUpdateRequest $request, TicketUser $ticketUser)
    {
        $ticketUser->update($request->validated());

        $request->session()->flash('ticketUser.id', $ticketUser->id);

        return redirect()->route('ticketUser.index');
    }
}
