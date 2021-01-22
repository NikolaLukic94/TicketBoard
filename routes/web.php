<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');


Route::get('/project', [App\Http\Controllers\ProjectController::class, 'index'])->name('project');

Route::resource('category', App\Http\Controllers\CategoryController::class)->only('index', 'store', 'update');

Route::resource('subcategory', App\Http\Controllers\SubcategoryController::class)->only('index', 'store', 'update');

Route::resource('ticket', App\Http\Controllers\TicketController::class)->except('create', 'edit', 'destroy');

Route::resource('ticket-user', App\Http\Controllers\TicketUserController::class)->only('index', 'store', 'update');

Route::resource('comment', App\Http\Controllers\CommentController::class)->only('index', 'store', 'update');


Route::resource('project', App\Http\Controllers\ProjectController::class)->only('index', 'store', 'update');

Route::resource('category', App\Http\Controllers\CategoryController::class)->only('index', 'store', 'update');

Route::resource('subcategory', App\Http\Controllers\SubcategoryController::class)->only('index', 'store', 'update');

Route::resource('ticket', App\Http\Controllers\TicketController::class)->except('create', 'edit', 'destroy');

Route::resource('ticket-user', App\Http\Controllers\TicketUserController::class)->only('index', 'store', 'update');

Route::resource('comment', App\Http\Controllers\CommentController::class)->only('index', 'store', 'update');
