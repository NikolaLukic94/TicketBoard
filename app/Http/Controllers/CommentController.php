<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentStoreRequest;
use App\Http\Requests\CommentUpdateRequest;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $comments = Comment::all();

        return view('comment.index', compact('comments'));
    }

    /**
     * @param \App\Http\Requests\CommentStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(CommentStoreRequest $request)
    {
        $comment = Comment::create($request->validated());

        $request->session()->flash('comment.id', $comment->id);

        return redirect()->route('comment.index');
    }

    /**
     * @param \App\Http\Requests\CommentUpdateRequest $request
     * @param \App\Models\Comment $comment
     * @return \Illuminate\Http\Response
     */
    public function update(CommentUpdateRequest $request, Comment $comment)
    {
        $comment->update($request->validated());

        $request->session()->flash('comment.id', $comment->id);

        return redirect()->route('comment.index');
    }
}
