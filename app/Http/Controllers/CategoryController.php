<?php

namespace App\Http\Controllers;

use App\Category;
use App\Repositories\CategoryRepository;
use App\Repositories\ItemsRepository;
use App\Repositories\StoreRepository;
use App\Store;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * @var CategoryRepository
     */
    protected $categoryRepository;

    /**
     * @var StoreRepository
     */
    protected $storeRepository;

    /**
     * @var ItemsRepository
     */
    protected $itemsRepository;

    public function __construct(CategoryRepository $categoryRepository, StoreRepository $storeRepository, ItemsRepository $itemsRepository)
    {
        $this->categoryRepository = $categoryRepository;
        $this->storeRepository = $storeRepository;
        $this->itemsRepository = $itemsRepository;
    }

    public function create()
    {
        $stores = $this->storeRepository->all();
        return view('categories.create', ['stores' => $stores]);
    }

    public function save(Request $request)
    {
        $this->categoryRepository->addCategory($request);
        return redirect()->back()->with('message', 'The category was created');
    }

    public function delete(Category $category)
    {

    }

    public function index(Category $category)
    {
        $items = $category->items()->get();
        $latest = $this->itemsRepository->latest(4);
        return view('categories.category', ['category' => $category, 'items' => $items, 'latest' => $latest]);
    }
}
