<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
	<!-- Bootstrap  -->
	<link rel="stylesheet" href="{!! asset('frontend/bootstrap.min.css') !!}">
    </head>
    <body>
        <style media="screen">
            @page {
                size: A4;
                margin:0;
                padding: 0;
            }
            /* .background{
                background-image: url({{ asset('images/logo/pdf-logo.png') }});
                background-repeat: no-repeat;
                background-size: 30px 30px;
                display: block;
                background-position: center;
            } */

            .header{
                padding: 20px;
                font-size: 13px;
            }
            .header p, h3{
                margin: 0;
                padding: 0;
                color: black;
            }
            .table tr td{
                color: black;
            }
            .no-border tr td{
    			border:0 !important;
    			padding: 2px !important;
    		}
            #watermark {
                position: fixed;

                /**
                    Set a position in the page for your image
                    This should center it vertically
                **/
                bottom:   10cm;
                left:     3.5cm;

                /** Change image dimensions**/
                width:    15cm;
                height:   10cm;

                /** Your watermark should be behind every content**/
                z-index:  -1000;
            }
        </style>
        <div style="padding-top:2em" class="fh5co-section-gray">
            <div class="container-fluid">
                <div id="watermark"   class="">
                    <img width="100%" height="100%" src="{{ asset('images/logo/pdf-logo.png') }}" alt="">
                </div>
                <div class="col-md-10 col-md-offset-1">
                    <div class="col-md-12">
                        <div class="">
                            <div class="panel-body background">
                                <div class="header">
                                    <div class="row">
                                        <div class="col-md-12 text-center">
                                            <img width="100px" src="{{ asset('images/logo/logo.png') }}" alt="">
                                            <h2 style="color:#F58435; margin:0" class="text-uppercase">{{ config('app.name') }}</h2>
                                            <h5 style="color:#F58435; margin:0">House: 45, Road: 13/C, Block: E, Banani, Dhaka, Bangladesh</h5>
                                            <h5 style="color:#F58435; margin:0">Email: ask@bdtravel.com</h5>
                                            <h5 style="color:#F58435; margin:0">Phone: 01789789789</h5>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <table class="table no-border">
                                                <tr>
                                                    <td width="50%"><b>Name </b></td>
                                                    <td width="1%"><b> : </b></td>
                                                    <td width="49%">{{ $booking_details->customer->name }}</td>
                                                </tr>
                                                <tr>
                                                    <td><b>Package </b></td>
                                                    <td><b> : </b></td>
                                                    <td>{{ $booking_details->package->title }}</td>
                                                </tr>
                                                <tr>
                                                    <td><b>Booking Type </b></td>
                                                    <td><b> : </b></td>
                                                    <td>{{ $booking_details->type->type }}</td>
                                                </tr>
                                                <tr>
                                                    <td><b>Adult Travelers </b></td>
                                                    <td><b> : </b></td>
                                                    <td>{{ $booking_details->num_of_travelers }}</td>
                                                </tr>
                                                @if ($booking_details->num_of_child)
                                                    <tr>
                                                        <td><b>Number of Child </b></td>
                                                        <td><b> : </b></td>
                                                        <td>{{ $booking_details->num_of_child }}</td>
                                                    </tr>
                                                @endif
                                                <tr>
                                                    <td><b>Booked On </b></td>
                                                    <td><b> : </b></td>
                                                    <td>{{ $booking_details->created_at->format('d-m-Y') }}</td>
                                                </tr>
                                                <tr>
                                                    <td><b>Total Cost </b></td>
                                                    <td><b> : </b></td>
                                                    <td>${{ strtoupper($booking_details->total_cost) }}</td>
                                                </tr>
                                            </table>
                                        </div>
                                        <div class="col-sm-6">
                                            <table class="table no-border">
                                                <tr>
                                                    <td><b>Payment ID </b></td>
                                                    <td><b> : </b></td>
                                                    <td>{{ strtoupper($booking_details->payment_id) }}</td>
                                                </tr>
                                                <tr>
                                                    <td width="50%"><b>Departure Date </b></td>
                                                    <td width="1%"><b> : </b></td>
                                                    <td width="49%">{{ $booking_details->package->departs_date }}</td>
                                                </tr>
                                                <tr>
                                                    <td><b>Return Date </b></td>
                                                    <td><b> : </b></td>
                                                    <td>{{ $booking_details->package->return_date }}</td>
                                                </tr>
                                                <tr>
                                                    <td><b>Places </b></td>
                                                    <td><b> : </b></td>
                                                    <td>
                                                        @if ($num_of_places = $booking_details->package->places->count())
                                                            @foreach ($booking_details->package->places as $place)
                                                                {{ $place->title }}
                                                                @if (--$num_of_places )
                                                                    ,
                                                                @endif
                                                            @endforeach
                                                        @endif
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><b>Hotels </b></td>
                                                    <td><b> : </b></td>
                                                    <td>
                                                        @if ($num_of_hotels = $booking_details->package->hotels->count())
                                                            @foreach ($booking_details->package->hotels as $hotel)
                                                                {{ $hotel->name }}
                                                                @if (--$num_of_hotels )
                                                                    ,
                                                                @endif
                                                            @endforeach
                                                        @endif
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <h3>Terms & Conditions:</h3>
                                            <ol style="padding-top:10px">
                                                <li>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</li>
                                                <li>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</li>
                                                <li>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</li>
                                                <li>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</li>
                                                <li>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</li>
                                                <li>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</li>

                                            </ol>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
