@extends('layouts.dashboard')

@section('content')

    <h1 class="h3 mb-3">Manage Connectivities</h1>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">

                    <div class="row">
                        <div class="col-6">
                            <h5 class="card-title mb-0">Connectivities List</h5>
                        </div>
                        <div class="col-6 text-end">
                            <a class="btn btn-sm btn-info" href="{{ route('dashboard.connectivities.create') }}">
                                <i class="bi bi-plus"></i>
                                Add New
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">


                    <div class="row">
                        <div class="col">

                            <livewire:dashboard.connectivities.connectivities-table/>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection
