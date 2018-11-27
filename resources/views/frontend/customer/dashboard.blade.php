@extends('layouts.frontend')
@section('content')
    <div style="padding-top:2em" id="fh5co-tours" class="fh5co-section-gray">
        <div class="container-fluid">
            <div class="col-md-8 col-md-offset-2">
                <div class="col-md-4">
                    @include('includes.customer.left_bar')
                </div>
                <div class="col-md-8">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">Booking Details</h3>
                        </div>
                        <div class="panel-body">
                            <div  id="accordion">
                                <table style="font-size: smaller" class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Package</th>
                                            <th scope="col">Total Cost</th>
                                            <th scope="col">Details</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                        $i=1
                                        @endphp
                                        @if ($booked_packages)
                                            @foreach ($booked_packages as $package)
                                                <tr>
                                                    <td scope="row">{{ $i++ }}</td>
                                                    <td><a href="{!! route('frontend.package.details',$package->package->slug) !!}">{{ $package->package->title }}</a></td>
                                                    <td>${{ $package->total_cost }}</td>
                                                    <td>
                                                        <a style="text-transform: none;" data-toggle="collapse" data-parent="#accordion" href="#{{$package->id}}"><i class="fa fa-eye"></i> View</a> |
                                                        <a style="text-transform: none;" href="{!! route('booking.package.show', $package->payment_id) !!}"><i class="fa fa-info"></i> Details</a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="padding:0 !important;border:0; margin:0" colspan="4">
                                                        <div id="{{$package->id}}" class="collapse">
                                                            <table class="table no-border">
                                                                <tr>
                                                                    <td width="25%">Package</td>
                                                                    <td width="1%">:</td>
                                                                    <td width="84%">
                                                                        {{ $package->package->title }}
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td width="25%">Type</td>
                                                                    <td width="1%">:</td>
                                                                    <td width="84%">{{ $package->type->type }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td width="25%">Travelers</td>
                                                                    <td width="1%">:</td>
                                                                    <td width="84%">{{ $package->num_of_travelers }}</td>
                                                                </tr>
                                                                @if ($package->num_of_child)
                                                                    <tr>
                                                                        <td width="25%">Number of Child</td>
                                                                        <td width="1%">:</td>
                                                                        <td width="84%">{{ $package->num_of_child }}</td>
                                                                    </tr>
                                                                @endif
                                                                <tr>
                                                                    <td width="25%">Total Cost</td>
                                                                    <td width="1%">:</td>
                                                                    <td width="84%">${{ $package->total_cost }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td width="25%">Booking Date</td>
                                                                    <td width="1%">:</td>
                                                                    <td width="84%">{{ date('d-M-Y', strtotime($package->created_at)) }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td width="25%">Contact Number</td>
                                                                    <td width="1%">:</td>
                                                                    <td width="84%">{{ $package->contact_number }}</td>
                                                                </tr>
                                                            </table>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-md-12 text-center animate-box">
                                <p>
                                    {{ $booked_packages->links('includes.pagination') }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
