@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                @include('partials.message')
                <div class="row">
                    <div class="col-md-offset-2 col-md-8 col-lg-offset-3 col-lg-6">
                    <div class="well profile">
                        <div class="col-sm-12">
                            <div class="col-xs-12 col-sm-8">
                                <h2>Event Details</h2>
                                <p><strong>Name: </strong> {{ $event->name ?? '' }} </p>
                                <p><strong>Start Date: </strong> {{ $event->start_date->format('d M Y') ?? '' }} </p>
                                <p><strong>End Date: </strong> {{ $event->end_date->format('d M Y') ?? '' }} </p>
                                <p><strong>No of Invited Users: </strong><span id="invitedCOunt"> {{ count($event->invited) ?? '' }}</span> </p>
                                <input type="hidden" name="invitedCuntVal" id="invitedCuntVal" value="{{ count($event->invited) ?? '' }}" />
                            </div>             
                        </div>            
                    </div>                 
                    </div>
                </div>

                <table class="table table-striped custab">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    @forelse ($event->invited as $row)
                        <tr id="row-{{$row->id}}">
                            <td>{{ ++$loop->index }}</td>
                            <td>{{ $row->email }}</td>
                            <td> <a class='btn btn-warning btn-xs remove-invitation' data-id="{{$row->id}}" href=""> Remove </a></td>
                        </tr>
                    @empty
                        <p>No Invited users </p>
                    @endforelse
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
@push('page-scripts')
<script src="{{asset('js/custom/invitation/invitation.js')}}"></script>
@endpush
