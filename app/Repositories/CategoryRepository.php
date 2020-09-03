<?php


namespace App\Repositories;


use App\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CategoryRepository
{

    public function all()
    {
        return Category::all();
    }

    public function addCategory(Request $request)
    {
        $validatedData = $request->validate([
            'name' => ['required', 'max:255'],
            'store_id' => ['required'],
            'image' => ['required'],
        ]);
        $category = new Category();
        $category->name = $validatedData['name'];
        $category->store_id = $validatedData['store_id'];
        $category->save();

        $category_update = Category::find($category->id);

        if ($request->hasFile('image')) {
            if ($request->file('image')->isValid()) {
                $extension = $request->image->extension();
                $filename = $category->id .'-' . Carbon::now()->unix() .'.' . $extension;
                $request->image->storeAs('/public', $filename);
                $category_update->image = $filename;
                $category_update->save();
            }
        }
    }
}
