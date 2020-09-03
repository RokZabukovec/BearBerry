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
        <form  action="{{ route('categories.save') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="item-name">Name</label>
                <input type="text" class="form-control" id="item-name" name="name">
            </div>

            <div class="form-group">
                <label for="items-stores">Store</label>
                <select class="custom-select custom-select-lg mb-3" id="items-stores" name="store_id">
                    <option disabled selected>-- Select store --</option>
                    @if(count($stores))
                        @foreach($stores as $store)
                            <option value="{{ $store->id }}">{{ $store->name }}</option>
                        @endforeach
                    @endif
                </select>
            </div>

            <div class="form-group">
                <label for="item-image">Category image</label>
                <input type="file" class="form-control-file" id="category-image" name="image">
            </div>

            <button type="submit" class="btn btn-black">Submit</button>
        </form>
    </div>
@endsection
