@extends('layouts.app')

@section('content')
    <h1 class="text-center text-small text-bold">{{ $category->name }}</h1>
    <div class="container-fluid">
        <section class="items">
            @if(count($items))
                @foreach($items as $item)
                    <a href="{{ route('item.view', ['item' => $item->id]) }}">
                        <div class="item-card flex-column">
                            <div class="item-image">
                                <img src="{{Storage::url($item->image)}}">
                            </div>
                            <div class="item-info">
                                <h5>{{ $item->name }}</h5>
                                <a class="btn btn-black" href="{{route('cart.addItem', ['item' => $item->id] )}}">Buy {{ $item->price }} €</a>
                            </div>
                        </div>
                    </a>
                @endforeach
            @else
            <h1 class="text-center text-uppercase empty">No items</h1>
            @endif
        </section>
    </div>
    @if(count($latest))
        <br>
        <hr>
        <br>
        <section class="container-fluid">
            <h1 class="text-bold text-uppercase">Latest</h1>
            <div class="items">
                @foreach($latest as $item)
                    <a href="{{ route('item.view', ['item' => $item->id]) }}">
                        <div class="item-card flex-column">
                            <div class="item-image">
                                <img src="{{Storage::url($item->image)}}">
                            </div>
                            <div class="item-info">
                                <h5>{{ $item->name }}</h5>
                                <a class="btn btn-black" href="{{route('cart.addItem', ['item' => $item->id] )}}">Buy {{ $item->price }} €</a>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </section>
    @endif
@endsection
