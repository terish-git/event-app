@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Events</div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-10 col-xl-12">
                            <div class="row">

                                <div class="col-md-6">
                                    <div class="md-form">
                                        <label for="search" class="">Search Event name or User name</label>
                                        <input type="text" name="search" id="search" class="form-control" placeholder="Search Event name or User name" />
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="md-form">
                                        <label for="dateRange" class="">Select a date range</label>
                                        <input type="text" class="form-control" name="dateRange" id="dateRange" onkeydown="return false" value="" autocomplete="off" />
                                    </div>
                                </div>
                                <!-- <div class="col-md-3">
                                    <div class="md-form">
                                        <label for="dateRange" class="">End date</label>
                                        <input type="text" class="form-control" name="end_date" id="end_date" onkeydown="return false" value="" autocomplete="off" />
                                    </div>
                                </div> -->
                            </div>
                        </div>
                        <br>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                    <div class="card-header">Events List</div>
                        <input type="hidden" name="start_date" id="start_date" value="" />
                        <input type="hidden" name="end_date" id="end_date" value=""/>
                        <div class="row col-md-12">
                            <table class="table table-striped custab">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Created By</th>
                                        <th>Start Date</th>
                                        <th>End Date</th>
                                    </tr>
                                </thead>
                                @include("public.event-pagination-data")
                                <input type="hidden" name="hidden_page" id="hidden_page" value="1" />
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
<script src="{{asset('js/custom/public/event.js')}}"></script>
@endpush