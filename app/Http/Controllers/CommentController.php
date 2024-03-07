<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Project $project, Request $request)
    {
        $user = Auth::user();

        $comment = new Comment();
        $comment->content = $request->content;
        $comment->user_id = $user->id;
        $comment->project_id = $project->id;

        $comment->save();

        return redirect()->back()->with('success', 'Comment created successfully!');
    }
    public function storeCat(Project $project, Category $category, Request $request)
    {
        $user = Auth::user();

        $comment = new Comment();
        $comment->content = $request->content;
        $comment->user_id = $user->id;
        $comment->category_id = $category->id;

        $comment->save();

        return redirect()->back()->with('success', 'Comment created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Comment $comment)
    {

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,Project $project,Category $category, Comment $comment)
    {
        $comment->fill([
            'content'=>$request->content,
        ]);
        $comment->save();

        return redirect()->back();
    }
    public function updatep(Request $request,Project $project, Comment $comment)
    {
        $comment->fill([
            'content'=>$request->content,
        ]);
        $comment->save();

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project,Comment $comment)
    {
        $comment->delete();
        return redirect()->back();
    }
    public function destroyp(Project $project,Comment $comment)
    {
        $comment->delete();
        return redirect()->back();
    }
}
