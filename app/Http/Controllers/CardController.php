<?php

namespace App\Http\Controllers;

use App\Models\Card;
use App\Models\Category;
use App\Models\Project;
use Illuminate\Http\Request;

class CardController extends Controller
{
    private const CARD_VALIDATOR = [
        'term' => 'required|min:2|max:50',
        'definition' => 'required|min:2|max:50'
    ];
    private const CARD_ERROR_MESSAGES = [
        'required' => 'Заполните поле',
        'max' => 'Значение не должно быть длинее :max символов',
        'min' => 'Значение не должно быть короче :min символов'
    ];

    /**
     * Show the form for creating a new resource.
     */
    public function create(Project $project, Category $category)
    {
        return view('card.create', compact('project', 'category'));
    }

    public function store(Request $request, Project $project, Category $category)
    {
        $validated = $request->validate(
            self::CARD_VALIDATOR,
            self::CARD_ERROR_MESSAGES
        );

        $category->cards()->create([
            'term' => $validated['term'],
            'definition' => $validated['definition']
        ]);

        return redirect()->route('category.show', compact('project', 'category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project, Category $category, Card $card)
    {
        return view('card.edit', compact('project', 'category', 'card'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project, Category $category, Card $card)
    {
        $validated = $request->validate(
            self::CARD_VALIDATOR,
            self::CARD_ERROR_MESSAGES
        );

        $card->fill([
            'term' => $validated['term'],
            'definition' => $validated['definition'],
        ]);

        $card->save();

        return redirect()->route('category.show', compact('project', 'category'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project, Category $category, Card $card)
    {
        $card->delete();
        return redirect()->route('category.show', compact('project', 'category'));
    }
}
