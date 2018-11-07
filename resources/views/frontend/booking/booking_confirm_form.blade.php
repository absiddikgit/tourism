@extends('layouts.frontend')
@section('styles')
    <style media="screen">
        .div-s{
            margin-top: 15px;
            background: white;
            border:1px solid #ddd
        }
        .s-input{
            padding:5px;
            line-height:0;
            width:300px
        }
        p{
            padding-top:15px 0 0 0;
            margin:0;
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
                    <span>Per Head Cost --- ${{ $package->cost }}</span> <br>
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
                <div id="" class="col-md-12 div-s text-justify">
                    <input type="hidden" name="per_head_cost" id="cost" value="{{ $package->cost }}">
                    <form style="padding:20px 5px" class="" action="{!! route('frontend.booking.pay-with-paypal') !!}" method="post">
                        {{ csrf_field() }}


                        <input type="hidden" name="package" value="{{ $package->id }}">
                        <input type="hidden" name="type" value="{{ $c_type->slug }}">
                        @if ($qty>2)
                            <input type="hidden" name="num_of_travelers" value="{{ $qty }}">
                        @endif


                        <div class="col-md-6">
                            <h4 style="margin:0; padding-bottom:10px">{{ $user->name }}</h4>
                            @if ($user->customerInfo)
                                <p>{{ $user->customerInfo->address }}</p>
                                <p>{{ $user->customerInfo->city }} {{ $user->customerInfo->country }} {{ $user->customerInfo->postcode }}</p>
                            @endif
                        </div>
                        <div class="col-md-6">
                            @if ($user->customerInfo)
                                <input class="s-input" type="text" name="contact_number" value="{{ $user->customerInfo->contact_number }}" placeholder="Enter your contact number" required>
                            @else
                                <input class="s-input" type="text" name="contact_number" value="" placeholder="Enter your contact number" required>
                            @endif
                        </div>

                        <div class="col-md-12">
                            <hr>
                        </div>

                        <div class="col-md-12">
                            <h4 style="margin:0; padding-bottom:10px">Booking Details</h4>
                            <p>Type: {{ $c_type->type }}</p>
                            <p>Travelers: {{ $qty }}</p>
                            <p>Total Cost: ${{ $total_cost }}</p>
                        </div>

                        <div style="padding-bottom:25px" class="col-md-12">
                            <input class="btn btn-primary pull-right" type="submit" name="" value="Pay With PayPal">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


@endsection
