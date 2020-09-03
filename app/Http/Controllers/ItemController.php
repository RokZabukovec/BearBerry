<?php

namespace App\Http\Controllers;

use App\Item;
use App\Repositories\CategoryRepository;
use App\Repositories\ItemsRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    /**
     * @var ItemsRepository
     */
    protected $itemsRepository;

    /**
     * @var CategoryRepository
     */
    protected $categoryRepository;

    public function __construct(ItemsRepository $itemsRepository, CategoryRepository $categoryRepository)
    {
        $this->itemsRepository = $itemsRepository;
        $this->categoryRepository = $categoryRepository;
    }

    public function viewItem(Item $item)
    {
        return view('items.item', ['item' => $item]);
    }

    public function create(Request $request)
    {
        $categories = $this->categoryRepository->all();
        return view('items.create', ['categories'=> $categories]);
    }

    public function save(Request $request)
    {

        $validatedData = $request->validate([
            'name' => ['required', 'unique:stores', 'max:255'],
            'quantity' => ['min:0'],
            'price' => ['min:0'],
            'category_id' => ['required'],
        ]);

        $item = new Item();
        $item->name = $validatedData['name'];
        $item->quantity = $validatedData['quantity'];
        $item->price = $validatedData['price'];
        $item->category_id = $validatedData['category_id'];
        $item->save();

        $item_update = Item::find($item->id);



        if ($request->hasFile('image')) {
            if ($request->file('image')->isValid()) {
                $request->validate([
                    'image' => 'mimes:jpeg,png',
                ]);

                $extension = $request->image->extension();
                $filename = $item->id .'-' . Carbon::now()->unix() .'.' . $extension;
                $request->image->storeAs('/public', $filename);
                $item_update->image = $filename;
                $item_update->save();
            }
        }
        return redirect()->back()->with('message', 'Item created.');
    }
}
