<?php

namespace App\Http\Controllers;

use App\Order;
use App\Repositories\OrderRepository;
use Illuminate\Http\Request;

class ConfigurationController extends Controller
{
    protected $orderRepository;

    public function __construct(OrderRepository $orderRepository) {
        $this->orderRepository = $orderRepository;
    }

    public function configuration()
    {
        $orders = $this->orderRepository->all('DESC');
        return view('configuration.configuration', ['orders' => $orders]);
    }

}
