@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Event Report</div>
                <div class="card-body">
                    <div class="row">
                        <div class="row col-md-12">
                            <table class="table table-striped custab">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Total no of Events</th>
                                    </tr>
                                </thead>
                                @forelse ($users as $user)
                                    <tr>
                                        <td>{{ ++$loop->index }}</td>
                                        <td>{{ $user->first_name }}</td>
                                        <td>{{ count($user->events) }}</td>
                                    </tr>
                                @empty
                                    <p>No Report </p>
                                @endforelse
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>


@endsection
@push('page-scripts')
@endpush
