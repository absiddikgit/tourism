@extends('layouts.admin')

@section('content')
    <div class="row clearfix">
        <div class="col-md-12">
            <div class="card">
                <div class="header">
                    <h2>Update Package Place & Hotel</h2>
                </div>
                <div class="body" style="overflow: hidden;">

                    <form action="{!! route('packages.update-place-hotel',$package_id) !!}" method="post">

                        {{ csrf_field() }} {{ method_field('put') }}
                        @include('includes.errors')
                        <div class="col-md-12">
                            <h3>Place</h3><hr>
                            @if ($places->count())
                                @foreach ($places as $place)
                                    <div class="col-md-3">
                                        <div class="img-thumbnail">
                                            <img width="100%" class="" src="{{ $place->placeImages?$place->placeImages[0]->image:'' }}" alt="">
                                            <div style="padding-top:5px" class="demo-checkbox">
                                                <input id="{{ $place->slug }}" value="{{ $place->id }}" {{ $place->package_id?'checked':'' }} type="checkbox" name="places[]">
                                                <label style="font-size:15px" for="{{ $place->slug }}">{{ $place->title }}</label>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>

                        <div class="col-md-12">
                            <h3>Hotel</h3><hr>
                            @if ($hotels->count())
                                @foreach ($hotels as $hotel)
                                    <div class="col-md-3">
                                        <div class="img-thumbnail">
                                            <img width="100%" class="" src="{{ $hotel->hotelImages?$hotel->hotelImages[0]->image:'' }}" alt="">
                                            <div style="padding-top:5px" class="demo-checkbox">
                                                <input id="{{ $hotel->slug }}" value="{{ $hotel->id }}" {{ $hotel->package_id?'checked':'' }} type="checkbox" name="hotels[]">
                                                <label style="font-size:15px" for="{{ $hotel->slug }}">{{ $hotel->name }}</label>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                        <div class="col-md-12">
                            <div class="pull-right">
                                <input class="btn btn-primary" type="submit" name="" value="Update">
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
