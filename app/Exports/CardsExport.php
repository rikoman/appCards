<?php

namespace App\Exports;

use App\Models\Card;
use App\Models\Category;
use Maatwebsite\Excel\Concerns\FromCollection;

class CardsExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    private $categoryId;

    public function __construct($categoryId)
    {
        $this->categoryId = $categoryId;
    }

    public function collection()
    {
        $category = Category::find($this->categoryId);
        return $category->cards()->select(['term','definition'])->get();
    }
}
