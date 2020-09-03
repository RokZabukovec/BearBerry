<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Item;
use App\Repositories\CartRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * @var CartRepository
     */
    protected $cartRepository;

    /**
     * CartController constructor.
     *
     * @param CartRepository $cartRepository
     */
    public function __construct(CartRepository $cartRepository)
    {
        $this->cartRepository = $cartRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cart = $this->cartRepository->cart();
        $items = $this->cartRepository->getItems($cart);
        $total = 0;
        if ($items)
        {
            foreach ($items as $item)
            {
                $total = $total + $item->price;
            }
        }

        return view('cart.cart', ['items' => $items, 'total' => $total]);
    }

    /**
     * Add item to the cart.
     *
     * @param Item
     */
    public function addItem(Item $item)
    {
        if (Auth::guest())
        {
            return redirect()->route('login')->with('message', 'You need to login to add items to the cart.');
        }

        $status = $this->cartRepository->addItem($item);
        if ($status)
        {
            return redirect()->back()->with('message', 'Item was added to the cart.');
        }
        return redirect()->back()->with('message', 'Could not add item to the cart!');
    }

    /**
     * Removes the item from the cart.
     *
     * @param Item $item
     */
    public function removeItem(Item $item)
    {
        $status = $this->cartRepository->removeItem($item);
        if ($status)
        {
            return redirect()->route('cart')->with('message', 'Item was removed from the cart.');
        }
        return redirect('cart')->with('message', 'Could not remove item from the cart!');
    }

}
