@extends('layouts.frontend')

@section('content')

    <div id="fh5co-tours" class="fh5co-section-gray mt-75">

        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2 text-center heading-section animate-box">
                    <h4>TYPE : {{ $type?strtoupper($type->type):'' }}</h4>
                    <div class="row">
                        @include('includes.search')
                    </div>
                </div>
            </div>

            <div class="row">
                @if (count($packages))
                    @foreach ($packages as $package)
                        {{-- <div class="col-md-4 col-sm-6 fh5co-tours animate-box" data-animate-effect="fadeIn">
                            <div href=""><img src="{{ ($package->places->count() && $package->places[0]->placeImages->count())?$package->places[0]->placeImages[0]->image:'' }}" alt="" class="img-responsive">
                                <div class="desc">
                                    <span></span>
                                    <h3><a style="color: white" href="{!! route('frontend.package.details',$package->slug) !!}">{{ $package->title }}</a></h3>
                                    <span>{{ $package->getInterval()? $package->getInterval().' days' : '1 day' }}</span>
                                    <span>{{ $package->departs_date.' to '.$package->return_date }}</span>
                                    <span class="price">${{ $package->cost }} <small style="font-size: 13px">( Per Head )</small> </span>
                                    <a class="btn btn-primary btn-outline" href="{!! route('frontend.package.booking',$package->slug) !!}">Book Now <i class="icon-arrow-right22"></i></a>
                                </div>
                            </div>
                        </div> --}}
                        <div style="margin-bottom:10px" class="col-md-4">
                            <div class="img-thumbnail" style="padding:0;">
                                <img width="300px" src="{{ $package->places && $package->places[0]->placeImages?$package->places[0]->placeImages[0]->image:'' }}" alt="" class="img-responsive">
                                <div style="margin:0 0 15px 0;padding:4px; background:#F78536;color:white" class="col-md-12">
                                    <div class="col-md-6">
                                        <h5 style="margin: 0;color:white;padding-top:15px"><i class="fa fa-clock"></i>  {{ $package->getInterval()>1? $package->getInterval().' days' : '1 day' }}</h5>
                                    </div>
                                    <div class="col-md-6" style="text-align:right">
                                        <h5 style="margin: 0;color:white">Per Head Cost</h5>
                                        <h3 style="margin: 0;color:white; padding-top:5px">${{ $package->cost }}</h3>
                                    </div>
                                </div>
                                <div style="padding:10px">
                                    <h3 style="margin:0"><a href="{!! route('frontend.package.details',$package->slug) !!}">{{ $package->title }}</a></h3>
                                    <span></span><br>
                                    <div style="line-height: 5px">
                                        <p> <i class="fa fa-map-marker-alt"></i> {{ $package->district->name.','.$package->division->name }}</p>
                                        <p>{{ $package->departs_date.' to '.$package->return_date }}</p>
                                        <p><b>Available Seat : {{ $package->availableSeat() }}</b></p>
                                    </div>
                                    @if ($package->availableSeat())
                                        <a class="btn btn-primary" href="{!! route('frontend.package.booking',$package->slug) !!}">Book Now <i class="icon-arrow-right22"></i></a>
                                    @else
                                        <a class="btn btn-primary" href="{!! route('frontend.package.details',$package->slug) !!}">Details <i class="icon-arrow-right22"></i></a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
                <div class="col-md-12 text-center animate-box">
                    <p>
                        {{ $packages?$packages->links('includes.pagination'):'' }}
                    </p>
                </div>
            </div>
        </div>
    </div>

@endsection
