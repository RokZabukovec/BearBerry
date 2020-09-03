<?php

namespace App\Http\Controllers;

use App\Repositories\ItemsRepository;
use App\Repositories\StoreRepository;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * @var ItemsRepository
     */
    protected $itemsRepository;

    /**
     * @var StoreRepository
     */
    protected $storeRepository;

    /**
     * @var User
     */
    protected $currentUser;

    /**
     * Create a new controller instance.
     *
     * @param ItemsRepository $itemsRepository
     * @param StoreRepository $storeRepository
     */
    public function __construct(ItemsRepository $itemsRepository, StoreRepository $storeRepository)
    {
        $this->itemsRepository = $itemsRepository;
        $this->storeRepository = $storeRepository;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $items = $this->itemsRepository->all();
        $stores = $this->storeRepository->all();
        return view('home', ['items' => $items, 'stores' => $stores]);
    }
}
