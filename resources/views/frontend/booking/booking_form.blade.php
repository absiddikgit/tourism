@extends('layouts.frontend')
@section('styles')
    <style media="screen">
        .div-s{
            margin-top: 15px;
            background: white;
            border:1px solid #ddd
        }
        .s-input{
            padding: 5px;
            width: 300px;
            margin-bottom: 5px;
        }
    </style>
@endsection
@section('content')
    <img style="width: 100%; height: 300px" src="{{
        ($package->places->count() && $package->places[0]->placeImages->count()) ?
        $package->places[0]->placeImages[0]->image : '' }}" alt="">
    <div style="padding-bottom:30px" class="container">
        <div class="row">
            <div style="margin-top: -15%" class="col-md-4 text-center">
                <div class="img-thumbnail" style="padding:0 0 4px 0;">
                    <img style="width: 100%;" src="{{
                        ($package->places->count() && $package->places[0]->placeImages->count()) ?
                        $package->places[0]->placeImages[0]->image : '' }}" alt="">
                        <p style="padding-top:15px">{{ $package->title }}</p>
                </div>
                <div class="col-md-12 div-s text-justify">
                    <h4 style="margin: 10px 0 10px 0"> <i class="icon-location"></i> {{ $package->district->name.', '.$package->division->name }}</h4>
                    <span>{{ $package->getInterval()>1? $package->getInterval().' days' : '1 day' }}</span> |
                    <span>{{ $package->departs_date }}<b> to </b> {{ $package->return_date }}</span> <br>
                    @if ($i = $package->types->count())
                        @foreach ($package->types as $type)
                            <span>{{ $type->type }}</span> {{ --$i?'|':'' }}
                        @endforeach
                    @endif
                </div>
                <div class="col-md-12 div-s text-justify">
                    <p>{!! $package->description !!}</p>
                </div>
            </div>
            <div style="padding-top:30px" class="col-md-8">
                <div id="booking_form" class="col-md-12 div-s text-justify">
                    <form style="padding:20px 5px" class="" action="" method="post">
                        <div class="form-group">
                            <label for="">Types:</label>
                            <div style="padding: 0px 50px">
                                @if ($package->types->count())
                                    @foreach ($package->types as $type)
                                        <input v-model="picked" type="radio" name="type" value="{{ $type->slug }}"> {{ $type->type }}<br>
                                        @if ($type->slug == 'family')
                                            <div v-show="picked === 'family'" style="padding: 5px 0 0 50px">
                                                <input class="s-input" type="text" name="num_of_travelers" value="" placeholder="Number of total travelers">
                                                <input class="s-input" type="text" name="num_of_child" value="" placeholder="Number of total childs">
                                            </div>
                                        @endif
                                    @endforeach
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                          <label for=""></label>
                          <input type="text" class="form-control" id="" placeholder="">
                          <p class="help-block">Help text here.</p>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>


@endsection
