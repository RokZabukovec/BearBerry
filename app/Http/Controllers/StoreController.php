<?php

namespace App\Http\Controllers;

use App\Category;
use App\Store;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    public function index(Store $store)
    {
        $categories = Category::where('store_id', $store->id)->get();
        return view('stores.store',
            [
                'store' => $store,
                'categories' => $categories,
            ]);
    }

    public function create()
    {
        return view('stores.create');
    }

    public function save(Request $request)
    {
        $validatedData = $request->validate([
            'name' => ['required', 'unique:stores', 'max:255']
        ]);
        Store::create($validatedData);
        return redirect()->back()->with('message', 'Store created.');
    }
}
