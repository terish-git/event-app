@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row col-md-12 col-md-offset-2 custyle">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Events Table</div>

                <div class="card-body">
                    @include('partials.message')
                    @if (count($events) > 0)
                        <table class="table table-striped custab">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                                @forelse ($events as $event)
                                    <tr id="{{$event->id}}">
                                        <td>{{ ++$loop->index }}</td>
                                        <td>{{ $event->name }}</td>
                                        <td>{{ $event->start_date->format('d M Y') }}</td>
                                        <td>{{ $event->end_date->format('d M Y') }}</td>
                            
                                        <td class="text-center">
                                                <a class='btn btn-secondary btn-xs inviteUsers' data-id="{{$event->id}}">Invite Users </a>
                                                <a class='btn btn-info btn-xs' href="{{ route('events.edit',$event->id) }}"> Edit </a> 
                                                <a class='btn btn-info btn-xs' href="{{ route('events.show',$event->id) }}"> View </a> 
                                                <a class='btn btn-danger btn-xs delete-event' data-id="{{$event->id}}" href="javascript:"> Delete </a> 
                                        </td>
                                    </tr>
                                @empty
                                    <p>No Events Found</p>
                                @endforelse
                        </table>
                    @else
                        <div class="col-xs-12 col-sm-12 center">
                            <h5 >No Events Found</h5>
                        </div>
                        
                    @endif
                    
                </div>
            </div>
        </div>
        
    </div>
</div>
@include('event.user-invite-modal')
   
@endsection
@push('page-scripts')
<script src="{{asset('js/custom/event/event.js')}}"></script>
@endpush
