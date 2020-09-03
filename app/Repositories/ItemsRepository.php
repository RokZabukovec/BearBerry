<?php


namespace App\Repositories;

use App\Item;
use Facades\App\Utils\Currency;
use Illuminate\Support\Facades\Auth;

class ItemsRepository
{

    public function all()
    {
        return Item::all();
    }

    public function getItemsByCategory(Category $category)
    {
        return Item::where('category_id', $category->id);
    }

    public function latest(int $number)
    {
        return Item::orderBy('created_at', 'desc')->take($number)->get();
    }
}
