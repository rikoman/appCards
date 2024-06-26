<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Project;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    private const CATEGORY_VALIDATOR = [
        'title' => ['required', 'min:2', 'max:50'],
        'description' => ['nullable', 'min:10', 'max:150'],
    ];

    private const CATEGORY_ERROR_MESSAGES = [
        'required' => 'Заполните поле',
        'max' => 'Значение не должно быть длинее :max символов',
        'min' => 'Значение не должно быть короче :min символов'
    ];

    /**
     * Show the form for creating a new resource.
     */
    public function create(Project $project)
    {
        return view('category.create', compact('project'));
    }

    public function store(Request $request, Project $project)
    {
        $validated = $request->validate(
            self::CATEGORY_VALIDATOR,
            self::CATEGORY_ERROR_MESSAGES,
        );

        $project->categories()->create([
            'title' => $validated['title'],
            'description' => $validated['description']
        ]);

        return redirect()->route('project.show', $project);
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project, Category $category)
    {
        $cards = $category->cards()->get();
        return view('category.show', compact('project', 'category', 'cards'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($project, Category $category)
    {
        return view('category.edit', compact('project', 'category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $projectId, Category $category)
    {
        $validated = $request->validate(
            self::CATEGORY_VALIDATOR,
            self::CATEGORY_ERROR_MESSAGES
        );

        $category->fill([
            'title' => $validated['title'],
            'description' => $validated['description'],
        ]);

        $category->save();

        return redirect()->route('project.show', $projectId);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($projectId, Category $category)
    {
        $category->delete();
        return redirect()->route('project.show', $projectId);
    }

    public function marathon(Project $project)
    {
        $allCards = array();

        foreach ($project->categories()->get() as $category) {
            foreach ($category->cards()->get() as $card) {
                $allCards[] = $card;
            }
        }
        return view('card.marathon', compact('project', 'allCards'));
    }
}
