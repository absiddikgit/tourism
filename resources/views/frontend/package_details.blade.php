@extends('layouts.frontend')

@section('content')
<img style="width: 100%; height: 300px" src="{{
    ($package->places->count() && $package->places[0]->placeImages->count()) ?
    $package->places[0]->placeImages[0]->image : '' }}" alt="">

<div style="margin-top:-300px" id="fh5co-blog-section" class="fh5co-section-gray">
    <div style="padding-top:35px">
        <div class="container">
            <div class="row">
                @if ($package->places->count())
                    @foreach ($package->places as $place)
                        <div class="col-md-4 col-sm-6 fh5co-tours animate-box" data-animate-effect="fadeIn">
                            <div href=""><img src="{{ $place->placeImages?$place->placeImages[0]->image:'' }}" alt="" class="img-responsive">
                                <div class="desc">
                                    <span></span>
                                    <h3><a style="color: white" href="{!! route('frontend.place.details',$place->slug) !!}">{{ $place->title }}</a></h3>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
            <br>
            <div class="row">
                <div class="col-md-12">
                    <div>
                        <h2 style="line-height: 55px !important; margin: 0">{{ $package->title }}</h2>
                        <h4 style="margin: 10px 0 10px 0"> <i class="icon-location"></i> {{ $package->district->name.', '.$package->division->name }}</h4>
                        <span>{{ $package->getInterval()>1? $package->getInterval().' days' : '1 day' }}</span> |
                        <span> <b> {{ $package->departs_date }}</b> to <b> {{ $package->return_date }} </b> </span> <br>
                        <span>Booking Deadline  <b> ${{ $package->booking_deadline }}</b></span> <br>
                        <span>Per Head  <b> ${{ $package->cost }}</b></span> <br>
                        @if ($i = $package->types->count())
                            @foreach ($package->types as $type)
                                <span>{{ $type->type }}</span> {{ --$i?'|':'' }}
                            @endforeach
                        @endif
                        @if ($package->status)
                            <br><br> <a class="btn btn-primary btn-outline" href="{!! route('frontend.package.booking',$package->slug) !!}">Book Now <i class="icon-arrow-right22"></i></a>
                        @endif
                    </div>
                    <p>{!! $package->description !!}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <h3>Hotels</h3>
                    @if ($package->hotels->count())
                        @foreach ($package->hotels as $hotel)
                            <div class="col-md-4 col-sm-6 fh5co-tours animate-box" data-animate-effect="fadeIn">
                                <div href=""><img src="{{ $hotel->hotelImages?$hotel->hotelImages[0]->image:'' }}" alt="" class="img-responsive">
                                    <div class="desc">
                                        <span></span>
                                        <h3><a style="color: white" href="{!! route('frontend.hotel.details',$hotel->slug) !!}">{{ $hotel->name }}</a></h3>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
