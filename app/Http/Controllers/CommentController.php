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
        'content' => ['required', 'max:300'],
    ];

    private const COMMENT_VALIDATOR_MESSAGES = [
        'required' => 'Заполните поле',
        'max' => 'Значение не должно быть длинее :max символов',
    ];


    /**
     * Store a newly created resource in storage.
     */
    public function storeForProject($projectId, Request $request)
    {
        $validated = $request->validate([
            self::COMMENT_VALIDATOR,
            self::COMMENT_VALIDATOR_MESSAGES
        ]);

        $user = Auth::user();

        $comment = new Comment();
        $comment->content = $validated['content'];
        $comment->user_id = $user->id;
        $comment->project_id = $projectId;

        $comment->save();

        return redirect()->back()->with('success', 'Comment created successfully!');
    }

    public function storeForCategory($projectId, $categoryId, Request $request)
    {
        $validated = $request->validate([
            self::COMMENT_VALIDATOR,
            self::COMMENT_VALIDATOR_MESSAGES
        ]);

        $user = Auth::user();

        $comment = new Comment();
        $comment->content = $validated['content'];
        $comment->user_id = $user->id;
        $comment->category_id = $categoryId;

        $comment->save();

        return redirect()->back()->with('success', 'Comment created successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     */
//    надо будет сделать
    public function edit(Project $project, Category $category, Comment $comment)
    {
        return view('comment.edit', compact('project', 'category', 'comment'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateForProject(Request $request, $projectId, Comment $comment)
    {
        $validated = $request->validate([
            self::COMMENT_VALIDATOR,
            self::COMMENT_VALIDATOR_MESSAGES
        ]);

        $comment->fill([
            'content' => $validated['content'],
        ]);
        $comment->save();

        return redirect()->route('project.show', $projectId);
    }

    public function updateForCategory(Request $request, $projectId, $categoryId, Comment $comment)
    {
        $validated = $request->validate([
            self::COMMENT_VALIDATOR,
            self::COMMENT_VALIDATOR_MESSAGES
        ]);

        $comment->fill([
            'content' => $validated['content'],
        ]);
        $comment->save();

        return redirect()->route('category.show', compact('projectId', 'categoryId'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroyForProject($project, Comment $comment)
    {
        $comment->delete();
        return redirect()->back();
    }

    public function destroyForCategory($projectId, $categoryId, Comment $comment)
    {
        $comment->delete();
        return redirect()->back();
    }
}
