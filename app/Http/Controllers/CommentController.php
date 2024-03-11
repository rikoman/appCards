<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    private const COMMENT_VALIDATOR = [
        'content'=>'required|min:2|max:150',
    ];

    private const COMMENT_VALIDATOR_MESSAGES = [
        'required' => 'Заполните поле',
        'max' => 'Значение не должно быть длинее :max символов',
        'min' => 'Значение не должно быть короче :min символов'
    ];


    /**
     * Store a newly created resource in storage.
     */
    public function store(Project $project, Request $request)
    {
        $validated = $request->validate([
            self::COMMENT_VALIDATOR,
            self::COMMENT_VALIDATOR_MESSAGES
        ]);

        $user = Auth::user();

        $comment = new Comment();
        $comment->content = $validated['content'];
        $comment->user_id = $user->id;
        $comment->project_id = $project->id;

        $comment->save();

        return redirect()->back()->with('success', 'Comment created successfully!');
    }

    public function storeCat(Project $project, Category $category, Request $request)
    {
        $validated = $request->validate([
            self::COMMENT_VALIDATOR,
            self::COMMENT_VALIDATOR_MESSAGES
        ]);

        $user = Auth::user();

        $comment = new Comment();
        $comment->content = $validated['content'];
        $comment->user_id = $user->id;
        $comment->category_id = $category->id;

        $comment->save();

        return redirect()->back()->with('success', 'Comment created successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project,Category $category, Comment $comment)
    {
        return view('comment.edit',compact('project','category','comment'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,Project $project,Category $category, Comment $comment)
    {
        $validated = $request->validate([
            self::COMMENT_VALIDATOR,
            self::COMMENT_VALIDATOR_MESSAGES
        ]);

        $comment->fill([
            'content'=>$validated['content'],
        ]);
        $comment->save();

        return redirect()->route('category.show',compact('project','category'));
    }
    public function updatep(Request $request,Project $project, Comment $comment)
    {
        $validated = $request->validate([
            self::COMMENT_VALIDATOR,
            self::COMMENT_VALIDATOR_MESSAGES
        ]);

        $comment->fill([
            'content'=>$validated['content'],
        ]);
        $comment->save();

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project,Category $category, Comment $comment)
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
