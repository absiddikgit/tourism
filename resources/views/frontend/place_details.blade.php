@extends('layouts.frontend')

@section('content')
    <img style="width: 100%; height: 300px" src="{{ $place->placeImages->count()?$place->placeImages[0]->image:'' }}" alt="">
    <div style="margin-top:-260px" id="fh5co-features">
        <div class="container">
            <div class="row">
                @if ($place->placeImages->count())
                    @foreach ($place->placeImages as $image)
                        <div style="padding-bottom:15px" class="col-md-4">
                            <img class="img-thumbnail" width="100%" src="{{ $image->image }}" alt="">
                        </div>
                    @endforeach
                @endif
            </div>
            <br>
            <div class="row">
                <div class="col-md-12">
                    <div>
                        <h2 style="line-height: 55px !important; margin: 0">{{ $place->title }}</h2>
                        <h4 style="margin: 0"> <i class="icon-location"></i> {{ $place->district->name.', '.$place->division->name }}</h4>
                    </div>
                    <p>{!! $place->description !!}</p>
                    <iframe width="100%" height="350" frameborder="0" style="border:0" src="https://www.google.com/maps/embed/v1/place?key=AIzaSyDVFg0qp7TwGBUTTzfqBeiTf-CRP_Rc1S8&q={{ $place->location }}" allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </div>

@endsection
