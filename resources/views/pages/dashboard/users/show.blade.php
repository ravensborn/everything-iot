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

                            <table class="table table-sm">
                                <tbody>
                                <tr>
                                    <th class="text-start">Name</th>
                                    <td class="text-start">{{ ucwords($user->name) }}</td>
                                </tr>
                                <tr>
                                    <th class="text-start">E-Mail Address</th>
                                    <td class="text-start">{{ $user->email }}</td>
                                </tr>
                                <tr>
                                    <th class="text-start">Country</th>
                                    <td class="text-start">{{ $user->country->iso_alpha_3 }}</td>
                                </tr>
                                <tr>
                                    <th class="text-start">E-Mail Verified</th>
                                    @if($user->email_verified_at)
                                        <td class="text-start">{{ $user->email_verified_at }}</td>
                                    @else
                                        <td class="text-start">Not verified</td>
                                    @endif
                                </tr>
                                <tr>
                                    <th class="text-start">Ban Status</th>
                                    @if($user->isBanned())
                                        <td class="text-start">{{ $user->bans->first }}</td>
                                    @else
                                        <td class="text-start">Not banned</td>
                                    @endif
                                </tr>
                                </tbody>
                            </table>

                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-md-12 col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">User Activity</h5>
                </div>
                <div class="card-body">
                    <table class="table table-sm">

                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Subject</th>
                            <th>Subject Id</th>
                            <th>Causer</th>
                            <th>Event</th>
                            <th>Description</th>
                        </tr>
                        </thead>

                        <tbody>
                        @forelse($activity as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->subject_type }}</td>
                                <td>{{ $item->subject_id }}</td>
                                <td>{{ $item->causer->name }}</td>
                                <td>{{ $item->event }}</td>
                                <td>{{ $item->description }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6">This user does not have any activity yet.</td>
                            </tr>
                        @endforelse

                        </tbody>

                    </table>
                </div>
            </div>
        </div>

    </div>

@endsection
