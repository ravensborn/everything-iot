@extends('layouts.dashboard')

@section('content')

    <h1 class="h3 mb-3">Manage Partners</h1>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">

                    <div class="row">
                        <div class="col-6">
                            <h5 class="card-title mb-0">Partners List</h5>
                        </div>
                        <div class="col-6 text-end">
                            <a class="btn btn-sm btn-info" href="{{ route('dashboard.partners.create') }}">
                                <i class="bi bi-plus"></i>
                                Add New
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">


                    <div class="row">
                        <div class="col">

                            <livewire:dashboard.partners.partners-table/>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection
