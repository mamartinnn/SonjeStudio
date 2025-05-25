@extends('layouts.admin')

@section('title', 'Dashboard Admin')

@section('content')
<div class="container py-4">
    <h1 class="mb-4">Dashboard Admin</h1>

    <div class="row">
        <div class="col-md-3 mb-3">
            <div class="card text-white bg-primary shadow">
                <div class="card-body">
                    <h5 class="card-title">Products</h5>
                    <p class="card-text fs-4">{{ $products }}</p>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-3">
            <div class="card text-white bg-danger shadow">
                <div class="card-body">
                    <h5 class="card-title">Users</h5>
                    <p class="card-text fs-4">{{ $users }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection