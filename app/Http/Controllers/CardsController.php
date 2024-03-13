<?php

namespace App\Http\Controllers;

use App\Exports\CardsExport;
use App\Imports\CardsImport;
use App\Models\Category;
use App\Models\Project;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class CardsController extends Controller
{
    public function export($project,$category)
    {
        return Excel::download(new CardsExport($category), 'cards.xlsx');
    }

    public function import(Request $request,$project,$category)
    {
        if ($request->hasFile('import_file')) {
            $file = $request->file('import_file');

            Excel::import(new CardsImport($category), $file);

            return redirect()->back()->with('success', 'Import successful!');
        }

        return redirect()->back()->with('error', 'No file selected!');
    }
}
