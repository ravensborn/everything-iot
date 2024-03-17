@extends('layouts.dashboard')

@section('content')

    <h1 class="h3 mb-3">Manage Connectivities</h1>

    <div class="row">
        <div class="col-md-10 col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Editing connectivity - {{ $connectivity->name }}</h5>
                </div>
                <div class="card-body">


                    <div class="row">
                        <div class="col">

                            @livewire('dashboard.connectivities.edit', ['connectivity' => $connectivity->id])

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>


@endsection
