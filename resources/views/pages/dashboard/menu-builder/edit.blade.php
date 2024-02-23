@extends('layouts.dashboard')

@section('content')

    <h1 class="h3 mb-3">Menu Builder</h1>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Editing Menu - {{ $menu->name }}</h5>
                    <div class="mt-1">
                        <a target="_blank" href="https://icons.getbootstrap.com/">Boostrap Icon Library</a>
                    </div>

                </div>
                <div class="card-body">

                    @livewire('dashboard.menu-builder.edit', ['menu' => $menu->id])
                </div>
            </div>
        </div>
    </div>

@endsection
