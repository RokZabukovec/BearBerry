@extends('layouts.app')

@section('content')
    <div class="container item-container">
        <div class="row">
            <div class="col-md-6 col-sm-12">
                <div class="image-full">
                    <img class="img-fluid" src="{{ Storage::url($item->image) }}" alt="{{ $item->name }}">
                </div>
            </div>
            <div class="col-md-6 col-sm-12 flex flex-column item-right">
                <h1 class="text-uppercase text-small text-bold">{{ $item->name }}</h1>
                <p class="text-uppercase">{{ $item->price }} €</p>
                <hr>
                <div class="item-description">
                    <p class="text-smaller text-bold text-uppercase"> Item detail</p>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Hic impedit ipsa nisi odio
                        officia quas quo veritatis voluptas! Ad, blanditiis consectetur deserunt dolores ex
                        exercitationem, ipsa magnam maxime molestiae non repellendus similique sit suscipit
                        tempore unde. Beatae culpa cupiditate ea, eaque error facilis fuga impedit molestias
                        non pariatur praesentium voluptatum.
                    </p>
                </div>
                <hr>
                <div class="item-returns">
                    <p class="text-smaller text-bold text-uppercase">Delivery details</p>
                    <p>
                        <span class="text-bold">Free Standard Shipping</span>
                        <br>
                        Place your order today and receive it within 3-5 working days.
                        <br>
                        <span class="text-bold">Express Shipping</span>
                        <br>
                        Place your order today and receive it within 1-3 working days.
                        <br>
                        <span class="text-bold">Free Gift Packaging</span>
                        <br>
                        Our gift packaging includes a signature Burberry gift box finished with a hand-tied ribbon.
                        <br>
                        <span class="text-bold">Free Returns</span>
                        <br>
                        Enjoy free returns on your order.
                    </p>
                </div>
                <a href="{{ route('cart.addItem', ['item' => $item->id]) }}" class="btn btn-block btn-black">Order</a>
            </div>
        </div>
    </div>
@endsection
