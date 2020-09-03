@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-bold">Shopping cart</h1>
        @if(count($items))
            <form action="{{ route('orders.send') }}" method="POST">
                @csrf
                @foreach($items as $item)
                    <div class="form-group form-inline cart-item">
                        <div>
                            <label for="item">{{ $item->name }}</label>
                            <input type="number" value=1 min="1" name="{{ $item->id }}" class="form-control cart-quantity" id="item">
                        </div>
                        <a href="{{ route('cart.removeItem', ['item' => $item->id]) }}">Remove Item</a>
                    </div>
                @endforeach
                <button type="submit" class="btn btn-black">Pay</button>
            </form>
            <hr>
            <div class="total flex">
                <h3>Total: <span>{{ $total }}</span> € </h3>
            </div>
            @else
            <div class="shopping-cart-empty">
                <p>Your shopping bag is empty.</p>
            </div>
        @endif
        <a class="btn btn-black" href="{{ route('home') }}">Continue shopping</a>
    </div>
@endsection
