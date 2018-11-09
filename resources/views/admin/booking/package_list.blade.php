@extends('layouts.admin')

@section('content')
    <div class="row clearfix">
        <div class="col-md-12">
            <div class="card">
                <div class="header">
                    <h2>Packages</h2>
                </div>
                <div class="body">
                    <div class="">
                        <table class="table table-bordered js-basic-example dataTable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Title</th>
                                    <th>Division</th>
                                    <th>District</th>
                                    <th>Departs Date</th>
                                    <th>Return Date</th>
                                    <th>Deadline Date</th>
                                    <th>Total Booking</th>
                                    <th>Total travelers</th>
                                    <th>Total cost</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            @php
                            $i = 1
                            @endphp
                            <tbody>
                                @if ($packages->count())
                                    @foreach ($packages as $p)
                                        <tr>
                                            <td>{{ $i++ }}</td>
                                            <td>{{ $p->title }}</td>
                                            <td>{{ $p->division->name }}</td>
                                            <td>{{ $p->district->name }}</td>
                                            <td>{{ $p->departs_date }}</td>
                                            <td>{{ $p->return_date }}</td>
                                            <td>{{ $p->booking_deadline }}</td>
                                            <td>{{ $p->booking->count() }}</td>
                                            <td>{{ $p->booking->sum('num_of_travelers') }}</td>
                                            <td>${{ $p->booking->sum('total_cost') }}</td>
                                            <td>
                                                <a href="{!! route('booking.list',$p->id) !!}">Booking Details</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
