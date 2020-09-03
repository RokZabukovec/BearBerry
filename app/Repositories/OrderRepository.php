<?php


namespace App\Repositories;

use App\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderRepository
{

    public function create(Request $request)
    {
        $data = $request->all();
        $order = new Order();
        $order->user_id = Auth::id();
        $order->save();

        foreach ($data as $item => $quantity)
        {
            if (empty($data))
            {
                return false;
            }

            if ($item == '_token')
            {
                continue;
            }

            $order->items()->attach($item, ['order_id'=> $order->id, 'quantity' => $quantity]);
        }
    }

    public function all($sort_by)
    {
        return Order::orderBy('created_at', 'DESC')->get();;
    }

}
