@extends('layouts.frontend')

@section('content')

    <div id="fh5co-blog-section" class="fh5co-section-gray">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2 text-center heading-section animate-box">
                    <h3>All Places</h3>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row row-bottom-padded-md">
                @if ($places->count())
                    @foreach ($places as $place)
                        <div style="margin-bottom:10px" class="col-md-4">
                            <div class="img-thumbnail" style="padding:0;">
                                <img width="300px" src="{{ $place->placeImages?$place->placeImages[0]->image:'' }}" alt="" class="img-responsive">
                                <div style="margin:0 0 15px 0;padding:4px; background:#F78536;color:white" class="col-md-12">
                                    <div class="col-md-6">
                                        <h3 style="margin: 0;color:white;padding: 15px 0">{{ $place->title }}</h3>
                                    </div>
                                </div>
                                <div style="padding:10px">
                                    <div class="prod-title">
                                        <P><i class="fa fa-map-marker-alt"></i> <b>{{ $place->district->name.', '.$place->division->name }}</b> </P>
                                        <p>{!! str_limit($place->description,150) !!}</p>
                                        <p><a href="{!! route('frontend.place.details',$place->slug) !!}">Learn More...</a></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
                <div class="clearfix visible-md-block"></div>
            </div>

            <div class="col-md-12 text-center animate-box">
                <p>
                    {{ $places->links('includes.pagination') }}
                </p>
            </div>

        </div>
    </div>

@endsection
