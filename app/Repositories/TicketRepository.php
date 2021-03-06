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
        $ticket = Ticket::find($request->id);

        $ticket->update([
            'title' => $request->title,
            'description' => $request->description,
            'target_date' => $request->targetDate,
            'urgency_level' => $request->urgencyLevel,
            'category_id' => $request->categoryId,
            'subcategory_id' => $request->subCategoryId,
        ]);

        $ticket->invlolvedTeamMembers()->sync([]);

        foreach ($request->watchUserIds as $watchUserId) {

            DB::table('ticket_user')->insert([
                'ticket_id' => $ticket->id,
                'user_id' => $watchUserId,
                'watcher' => 1,
                'assigned' => 0
            ]);
        }

        DB::table('ticket_user')->insert([
            'ticket_id' => $ticket->id,
            'user_id' => $request->assignedToId,
            'watcher' => 1,
            'assigned' => 0
        ]);
    }

    public function delete($id)
    {
        Ticket::find($id)->delete();
    }
}
