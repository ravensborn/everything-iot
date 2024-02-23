@extends('layouts.dashboard')

@section('content')

    <h1 class="h3 mb-3">Manage Orders</h1>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Orders List</h5>
                </div>
                <div class="card-body">


                    <div class="row">
                        <div class="col">

                            <livewire:dashboard.orders.orders-table />

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>


@endsection
