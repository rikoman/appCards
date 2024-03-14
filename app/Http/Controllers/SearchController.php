<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('query');

        $results = Project::where('title', 'like', "%$query%")->get();

        return view('search_results', compact('results'));
    }
}
