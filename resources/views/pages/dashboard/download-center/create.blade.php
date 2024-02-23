@extends('layouts.dashboard')

@section('content')

    <h1 class="h3 mb-3">Manage Download Center</h1>

    <div class="row">
        <div class="col-md-10 col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Upload a new file</h5>
                </div>
                <div class="card-body">


                    <div class="row">
                        <div class="col">

                            @livewire('dashboard.download-center.create')

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>


@endsection
