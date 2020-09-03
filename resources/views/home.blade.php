@extends('layouts.app')

@section('content')
    <div class="hero">
        <div class="hero-image">
            <img src="https://images.unsplash.com/photo-1483985988355-763728e1935b?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=2250&q=80" alt="">
        </div>
        <div class="hero-overlay"></div>
        <div class="hero-description">
            <h1>BearBerry</h1>
            <p>Fashion made affordable.</p>
        </div>
    </div>
    <div class="container-fluid mt-5">
        <h1 class="text-center text-small text-bold text-uppercase"> All items</h1>
            @if(count($items))
                <section class="items">
                    @foreach($items as $item)
                        <a href="{{ route('item.view', ['item' => $item->id]) }}">
                            <div class="item-card flex-column">
                                <div class="item-image">
                                    <img src="{{Storage::url($item->image)}}">
                                </div>
                                <div class="item-info">
                                    <h5>{{ $item->name }}</h5>
                                    <a class="btn btn-black" href="{{route('cart.addItem', ['item' => $item->id] )}}">Buy {{ $item->price }}</a>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </section>
            @else
                <div class="empty flex-column align-middle text-center">
                    <h1 class="text-small text-bold">No items</h1>
                    @if(Auth::user() && Auth::user()->hasRole('administrator'))
                        <a href="{{ route('item.create') }}" class="text-center btn btn-black"> Create items </a>
                    @endif
                </div>
            @endif
    </div>
@endsection
