<?php

namespace App\Imports;

use App\Models\Card;
use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;

class CardsImport implements ToModel
{
    private $categoryId;

    public function __construct($categoryId)
    {
        $this->categoryId = $categoryId;
    }

    public function model(array $row)
    {
        $card = new Card();
        $card->term=$row[0];
        $card->definition=$row[1];
        $card->category_id=$this->categoryId;
        return $card;
    }
}
