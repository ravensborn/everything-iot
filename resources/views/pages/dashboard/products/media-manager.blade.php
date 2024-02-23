@extends('layouts.dashboard')

@section('content')

    <h1 class="h3 mb-3">Manage Products</h1>



    <div class="row">
        <div class="col-md-10 col-12">
            <div class="card">
                <div class="card-body">
                    <h5>Product - {{ $product->name }}</h5>
                </div>
            </div>
        </div>
    </div>


    @livewire('dashboard.products.media-manager', ['product' => $product->id])



@endsection
