<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    private const PROJECT_VALIDATOR = [
        'title' => 'required|min:2|max:50',
        'description' => 'nullable|min:10|max:150',
    ];

    private const PROJECT_ERROR_MESSAGES = [
        'required' => 'Заполните поле',
        'max' => 'Значение не должно быть длинее :max символов',
        'min' => 'Значение не должно быть короче :min символов'
    ];

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::orderBy('numberOfVisits', 'desc')->paginate(10);
        return view('project.index', compact('projects'));
    }


    public function home()
    {
        $projects = Auth::user()->projects()->get();
        return view('project.home', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('project.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate(
            self::PROJECT_VALIDATOR,
            self::PROJECT_ERROR_MESSAGES
        );

        $data = $request->file('image')->store('', 'projects');

        Auth::user()->projects()->create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'image' => $data,
        ]);
        return redirect()->route('project.home');
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        $project->increment('numberOfVisits');
        $project->save();

        $categories = $project->categories()->get();
        return view('project.show', compact('project', 'categories'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        return view('project.edit', ['project' => $project]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        $validated = $request->validate(
            self::PROJECT_VALIDATOR,
            self::PROJECT_ERROR_MESSAGES
        );

        $data = $request->file('image')->store('', 'projects');

        $project->fill([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'image'=>$data
        ]);
        $project->save();

        return redirect()->route('project.home');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        Storage::disk('projects')->delete($project->image);
        $project->delete();
        return redirect()->back();
    }

    public function subscribed(Project $project)
    {
        Auth::user()->subprojects()->attach($project);
        return redirect()->back()->with('success', 'Project subscribed successfully!');
    }

    public function unsubscribed(Project $project)
    {
        Auth::user()->subprojects()->detach($project);
        return redirect()->back()->with('success', 'Project subscribed successfully!');
    }

    public function subProjects()
    {
        return view('subprojects', ['subprojects' => Auth::user()->subprojects()->get()]);
    }
}
