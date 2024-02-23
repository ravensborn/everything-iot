@extends('layouts.dashboard')

@section('content')

    <h1 class="h3 mb-3">Manage Team Members</h1>

    <div class="row">
        <div class="col-md-10 col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Editing team member - {{ $teamMember->name }}</h5>
                </div>
                <div class="card-body">


                    <div class="row">
                        <div class="col">

                            @livewire('dashboard.team-members.edit', ['teamMember' => $teamMember->id])

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>


@endsection
