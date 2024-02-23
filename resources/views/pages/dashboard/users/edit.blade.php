@extends('layouts.dashboard')

@section('content')

    <h1 class="h3 mb-3">Manage Users - {{ $user->email }}</h1>

    <div class="row">
        <div class="col-md-6 col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">User Information</h5>
                </div>
                <div class="card-body">

                    <div class="row">
                        <div class="col">
                            <livewire:dashboard.users.edit user="{{ $user->id }}"/>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-md-6 col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">User Roles</h5>
                </div>
                <div class="card-body">

                    <livewire:dashboard.users.role-manager user="{{ $user->id }}"/>
                </div>
            </div>
        </div>
    </div>

@endsection
