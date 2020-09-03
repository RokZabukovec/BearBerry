<?php


namespace App\Repositories;


use App\Cart;
use App\Item;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartRepository
{
    public function cart()
    {
        return Cart::where('user_id', Auth::user()->id)->get()->first();
    }

    public function getItems()
    {
        $items_ids = DB::select('select item_id from cart_item where cart_id = :id', ['id' => $this->cart()->id]);
        $items = Item::whereIn('id', array_column($items_ids, 'item_id'))->get();
        return $items;
    }

    public function addItem(Item $item)
    {
        try {
            $items = $this->cart()->items()->where('item_id', $item->id)->first();
           if (empty($items))
           {
               $this->cart()->items()->attach($item->id);
               return true;
           }
            return false;
        }catch(\Exception $e)
        {
            return false;
        }

    }

    public function removeItem(Item $item)
    {
        return $this->cart()->items()->detach($item->id);
    }

    public function dump()
    {
        $items = $this->cart()->items()->get();
        if (empty($items))
        {
            return false;
        }
        foreach ($items as $item)
        {
            $this->removeItem($item);
        }
    }

}
