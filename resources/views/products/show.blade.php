<!-- show.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $product->name }}</h1>
    
    <div class="row">
        <div class="col-md-6">
            <div class="main-image">
                @if($product->featuredImage)
                    <img src="{{ asset('storage/'.$product->featuredImage->path) }}" class="img-fluid" alt="Featured">
                @endif
            </div>
        </div>
        
        <div class="col-md-6">
            <p><strong>Price:</strong> ${{ number_format($product->price, 2) }}</p>
            <p><strong>Stock:</strong> {{ $product->stock }}</p>
            <p>{{ $product->description }}</p>
        </div>
    </div>

    <div class="row mt-4">
        @foreach($product->images as $image)
        <div class="col-md-3 mb-3">
            <div class="card">
                <img src="{{ asset('storage/'.$image->path) }}" class="card-img-top">
                <div class="card-body">
                    <form action="{{ route('products.setFeatured', $image) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-sm {{ $image->is_featured ? 'btn-success' : 'btn-outline-secondary' }}">
                            {{ $image->is_featured ? 'Featured' : 'Set Featured' }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <a href="{{ route('products.index') }}" class="btn btn-secondary">Back</a>
</div>
@endsection