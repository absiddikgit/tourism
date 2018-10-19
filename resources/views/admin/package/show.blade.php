@extends('layouts.admin')

@section('content')
    <div class="row clearfix">
        <div class="card">
            <div class="header">
                <h2>Package</h2>
            </div>
            <div class="body">
                <table class="table no-border">
                    <tr>
                        <td width="120px">Package Title</td>
                        <td width="1px">:</td>
                        <td>{{ $package->title }}</td>
                    </tr>
                    <tr>
                        <td width="120px">Departs Date</td>
                        <td width="1px">:</td>
                        <td>{{ $package->departs_date }}</td>
                    </tr>
                    <tr>
                        <td width="120px">Return Date</td>
                        <td width="1px">:</td>
                        <td>{{ $package->return_date }}</td>
                    </tr>
                    <tr>
                        <td width="120px">Duration</td>
                        <td width="1px">:</td>
                        <td>{{ $package->getInterval() }} days</td>
                    </tr>
                    <tr>
                        <td width="120px">Deadline Date</td>
                        <td width="1px">:</td>
                        <td>{{ $package->booking_deadline }}</td>
                    </tr>
                    <tr>
                        <td width="120px">Status</td>
                        <td width="1px">:</td>
                        <td>{{ $package->status }}</td>
                    </tr>
                    <tr>
                        <td width="120px">Type & Cost</td>
                        <td width="1px">:</td>
                        <td>
                            @foreach ($package->packageTypeCost as $ptc)
                                <table>
                                    <tr>
                                        <td width="80px">{{ $ptc->packageType->type }}</td>
                                        <td width="1px">:</td>
                                        <td>{{ $ptc->cost }}</td>
                                    </tr>
                                </table>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3"><a class="btn btn-sm btn-primary pull-right" href="{!! route('packages.edit',$package->id) !!}">Update</a></td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="card">
            <div class="header">
                <h2>Place & Hotel</h2>
            </div>
            <div class="body">
                <table class="table no-border">
                    <thead>
                        <th width="30px">Place</th>
                        <th></th>
                    </thead>
                    <tbody>
                        <tr>
                            <td></td>
                            <td>
                                @foreach ($package->places as $place)
                                    <div class="col-md-3">
                                        <div class="img-thumbnail">
                                            <img width="100%" class="" src="{{ $place->placeImages[0]->image }}" alt="">
                                            <label style="font-size:15px;padding-top:10px" for=" value.slug "> {{ $place->title }} </label>
                                        </div>
                                    </div>
                                @endforeach
                            </td>
                        </tr>
                    </tbody>
                </table>
                <table class="table no-border">
                    <thead>
                        <th width="30px">Hotel</th>
                        <th></th>
                    </thead>
                    <tbody>
                        <tr>
                            <td></td>
                            <td>
                                @foreach ($package->hotels as $hotel)
                                    <div class="col-md-3">
                                        <div class="img-thumbnail">
                                            <img width="100%" class="" src="{{ $hotel->hotelImages[0]->image }}" alt="">
                                            <label style="font-size:15px;padding-top:10px" for=" value.slug "> {{ $hotel->name }} </label>
                                        </div>
                                    </div>
                                @endforeach
                            </td>
                        </tr>
                    </tbody>
                </table>
                <table class="table no-border">
                    <tr>
                        <td colspan="3"><a class="btn btn-sm btn-primary pull-right" href="#">Update</a></td>
                    </tr>
                </table>


            </div>
        </div>
    </div>
@endsection