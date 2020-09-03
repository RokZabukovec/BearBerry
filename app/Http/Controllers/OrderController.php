<?php

namespace App\Http\Controllers;

use App\Events\CustomerOrderedEvent;
use App\Mail\OrderConfirm;
use App\Order;
use App\Repositories\CartRepository;
use App\Repositories\OrderRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    /**
     * @var CartRepository
     */
    protected $cartRepository;

    /**
     * @var OrderRepository
     */
    protected $orderRepository;

    public function __construct(OrderRepository $orderRepository, CartRepository $cartRepository)
    {
        $this->orderRepository = $orderRepository;
        $this->cartRepository = $cartRepository;
    }

    public function index()
    {
        $orders = Order::all();
        return view('orders.orders', ['orders' => $orders]);
    }

    public function send(Request $request)
    {
        $this->orderRepository->create($request);
        $this->cartRepository->dump();
        CustomerOrderedEvent::dispatch($request);
        Mail::mailer('smtp')
            ->to('rok.zabukovec.it@gmail.com')
            ->send(new OrderConfirm());
        return redirect()->back()->with('message', 'Your order was a success!');
    }

}
