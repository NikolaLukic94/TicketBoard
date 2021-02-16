<?php

namespace App\Repositories;

use App\Models\Ticket;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TicketRepository implements TicketRepositoryInterface
{
    public function store($request)
    {
        $ticket = Ticket::create([
            'uuid' => Carbon::now()->format('YmdHis') . Auth::id(),
            'title' => $request->title,
            'description' => $request->description,
            'target_date' => $request->targetDate,
            'urgency_level' => $request->urgencyLevel,
            'category_id' => $request->categoryId,
            'subcategory_id' => $request->subCategoryId,
            'author_id' => Auth::id(),
        ]);

        $ticket->invlolvedTeamMembers()->detach();

        $ticket->invlolvedTeamMembers()->attach($request->watchUserIds, ['watcher' => 1]);

        DB::table('ticket_user')->insert([
            'ticket_id' => $ticket->id,
            'user_id' => $request->assignedToId,
            'assigned' => 1
        ]);
    }

    public function update($request)
    {
        $project = Ticket::find($request->id);

        $project->update([
            'title' => $request->title,
            'description' => $request->description,
            'target_date' => $request->targetDate,
            'urgency_level' => $request->urgencyLevel,
            'category_id' => $request->categoryId,
            'subcategory_id' => $request->subCategoryId,
        ]);
    }

    public function delete($id)
    {
        Ticket::find($id)->delete();
    }
}
