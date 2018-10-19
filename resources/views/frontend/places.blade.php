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
                        <div class="col-lg-4 col-md-4 col-sm-6">
                            <div class="fh5co-blog animate-box">
                                <a href="#"><img class="img-responsive" src="{{ $place->placeImages[0]->image }}" alt=""></a>
                                <div class="blog-text">
                                    <div class="prod-title">
                                        <h3><a href="#">{{ $place->title }}</a></h3>
                                        <P class="">{{ $place->district->name.', '.$place->division->name }}</P>
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
