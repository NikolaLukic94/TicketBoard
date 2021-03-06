<?php

use App\Models\Ticket;
use App\Models\User;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| On dashboard page, show tickets where user is watcher
| On dashboard page, show tickets where user is assigned
| Add status to ticket, open, in progress or closed
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    $user = \Illuminate\Support\Facades\Auth::user();

    return view('dashboard', [
        'ticketsDueToday' => Ticket::dueToday()->count(),
        'tickets' => Ticket::get(),
        'user' => $user
    ]);
})->name('dashboard');

Route::get('/project', [App\Http\Controllers\ProjectController::class, 'index'])->name('project');

Route::get('/category', [App\Http\Controllers\CategoryController::class, 'index'])->name('category');

Route::get('/subcategory', [App\Http\Controllers\SubcategoryController::class, 'index'])->name('subcategory');

Route::resource('ticket', App\Http\Controllers\TicketController::class)->except('create', 'edit', 'destroy');
Route::get('board/{id}', [App\Http\Controllers\TicketController::class, 'board']);

Route::resource('ticket-user', App\Http\Controllers\TicketUserController::class)->only('index', 'store', 'update');

Route::resource('comment', App\Http\Controllers\CommentController::class)->only('index', 'store', 'update');


Route::resource('project', App\Http\Controllers\ProjectController::class)->only('index', 'store', 'update');

Route::resource('category', App\Http\Controllers\CategoryController::class)->only('index', 'store', 'update');

Route::resource('subcategory', App\Http\Controllers\SubcategoryController::class)->only('index', 'store', 'update');

Route::resource('ticket', App\Http\Controllers\TicketController::class)->except('create', 'edit', 'destroy');

Route::resource('ticket-user', App\Http\Controllers\TicketUserController::class)->only('index', 'store', 'update');

Route::resource('comment', App\Http\Controllers\CommentController::class)->only('index', 'store', 'update');
