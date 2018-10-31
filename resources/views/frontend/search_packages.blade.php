@extends('layouts.frontend')

@section('content')

    <div id="fh5co-tours" class="fh5co-section-gray">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2 text-center heading-section animate-box">
                    <h3>Packages</h3>
                </div>
            </div>
            <div class="row">
                @if (count($packages))
                    @foreach ($packages as $package)
                        <div class="col-md-4 col-sm-6 fh5co-tours animate-box" data-animate-effect="fadeIn">
                            <div href=""><img src="{{ ($package->places->count() && $package->places[0]->placeImages->count())?$package->places[0]->placeImages[0]->image:'' }}" alt="Free HTML5 Website Template by FreeHTML5.co" class="img-responsive">
                                <div class="desc">
                                    <span></span>
                                    <h3><a style="color: white" href="{!! route('frontend.package.details',$package->slug) !!}">{{ $package->title }}</a></h3>
                                    <span>{{ $package->getInterval()>1? $package->getInterval().' days' : '1 day' }}</span>
                                    <span>{{ $package->departs_date.' to '.$package->return_date }}</span>
                                    <span class="price">৳{{ $package->cost?$package->cost:$package->getMinCost->cost }}</span>
                                    <a class="btn btn-primary btn-outline" href="#">Book Now <i class="icon-arrow-right22"></i></a>
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
