@extends('layouts.dashboard')

@section('content')

    <h1 class="h3 mb-3">Menu Builder</h1>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">

                    <div class="row">
                        <div class="col-6">
                            <h5 class="card-title mb-0">Menu List</h5>
                        </div>
                        <div class="col-6 text-end">

                        </div>
                    </div>
                </div>
                <div class="card-body">

                    <div class="row">
                        <div class="col">

                            <livewire:dashboard.menu-builder.index/>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection

