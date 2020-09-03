@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-center text-small text-bold text-uppercase">{{ $store->name }}</h1>

        <div class="category-grid">
            @if(count($categories))
                @foreach($categories as $category)
                <a href="{{ route('categories.view', ['category' => $category->id]) }}" class="category">
                    <div class="category-image">
                        <img src="{{ Storage::url($category->image) }}" alt="{{ $category->name }}">
                    </div>
                    <div class="category-name text-bold text-uppercase">
                        {{ $category->name }}
                    </div>
                </a>
                @endforeach
            @else
                <div class="empty">
                    <h3>No categories.</h3>
                </div>
            @endif
        </div>
    </div>
@endsection
