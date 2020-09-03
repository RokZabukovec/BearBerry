@extends('layouts.app')

@section('content')
    <div class="container">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form  action="{{ route('item.save') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="item-name">Name</label>
                <input type="text" class="form-control" id="item-name" name="name">
            </div>
            <div class="form-group">
                <label for="item-quantity">Quantity</label>
                <input type="number" min="0" value="0" class="form-control" id="item-quantity" name="quantity">
            </div>

            <div class="form-group">
                <label for="item-price">Price</label>
                <input type="number" min="0" value="0" step="0.01" class="form-control" id="item-price" name="price">
            </div>

            <div class="form-group">
                <label for="items-stores">Store</label>
                <select class="custom-select custom-select-lg mb-3" id="items-stores" name="category_id">
                    <option disabled selected>-- Select category --</option>
                    @if(count($categories))
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    @endif
                </select>
            </div>
            <div class="form-group">
                <label for="item-image">Item image</label>
                <input type="file" class="form-control-file" id="item-image" name="image">
            </div>
            <button type="submit" class="btn btn-black">Submit</button>
        </form>
    </div>
@endsection
