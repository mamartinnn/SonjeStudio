<!-- index.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Products</h1>
    <a href="{{ route('products.create') }}" class="btn btn-primary mb-3">Create New</a>
    
    <div class="row">
        @foreach ($products as $product)
        <div class="col-md-4 mb-4">
            <div class="card">
                @if($product->featuredImage)
                    <img src="{{ asset('storage/'.$product->featuredImage->path) }}" class="card-img-top" alt="{{ $product->name }}">
                @endif
                <div class="card-body">
                    <h5 class="card-title">{{ $product->name }}</h5>
                    <p class="card-text">${{ number_format($product->price, 2) }}</p>
                    <a href="{{ route('products.show', $product) }}" class="btn btn-info">View</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    
    {{ $products->links() }}
</div>
@endsection