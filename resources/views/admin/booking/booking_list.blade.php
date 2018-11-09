@extends('layouts.admin')
@section('styles')
    <style media="screen">
        .no-border tr td{
            border: 0 !important;
        }
    </style>
@endsection
@section('content')
    <div class="row clearfix">
        <div class="col-md-12">
            <div class="card">
                <div class="header">
                    <h2>Booking details</h2>
                </div>
                <div class="body">
                    <div class="">
                        <table class="table table-bordered js-basic-example dataTable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Customer</th>
                                    <th>Type</th>
                                    <th>Travelers</th>
                                    <th>Cost</th>
                                    <th>Booking Date</th>
                                </tr>
                            </thead>
                            @php
                            $i = 1
                            @endphp
                            <tbody>
                                @if ($booking_details->count())
                                    @foreach ($booking_details as $bd)
                                        <tr>
                                            <td>{{ $i++ }}</td>
                                            <td>{{ $bd->customer->name }}</td>
                                            <td>{{ $bd->type->type }}</td>
                                            <td>{{ $bd->num_of_travelers }}</td>
                                            <td>${{ $bd->total_cost }}</td>
                                            <td>{{ date('d-m-Y', strtotime($bd->created_at)) }}</td>

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
