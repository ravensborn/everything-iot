@extends('layouts.dashboard')

@section('content')

    <h1 class="h3 mb-3">Manage Posts</h1>

    <div class="row">
        <div class="col-md-10 col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Editing post - {{ $post->title }}</h5>
                </div>
                <div class="card-body">


                    <div class="row">
                        <div class="col">

                            @livewire('dashboard.posts.edit', ['post' => $post->id])

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>


@endsection
