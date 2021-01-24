<?php

namespace App\Repositories;

use App\Models\Ticket;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class TicketRepository implements TicketRepositoryInterface
{
    public function store($request)
    {
        Ticket::create([
            'uuid' => Carbon::now()->format('YmdHis') . Auth::id(),
            'title' => $request->title,
            'description' => $request->description,
            'target_date' => $request->targetDate,
            'urgency_level' => $request->urgencyLevel,
            'category_id' => $request->categoryId,
            'subcategory_id' => $request->subCategoryId,
            'author_id' => Auth::id(),
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
