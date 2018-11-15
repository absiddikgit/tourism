@extends('layouts.frontend')

@section('content')

    <div class="fh5co-hero">
        <div class="fh5co-overlay"></div>
        <div class="fh5co-cover" data-stellar-background-ratio="0.5" style="background-image: url({!! asset('frontend/images/cover_bg_1.jpg') !!});">
            <div class="desc">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-5 col-md-5">
                            <div class="tabulation animate-box">

                                <!-- Nav tabs -->
                                <ul class="nav nav-tabs" role="tablist">
                                    <li role="presentation" class="active">
                                        <a href="#flights" aria-controls="flights" role="tab" data-toggle="tab">Packages</a>
                                    </li>
                                </ul>

                                <!-- Tab panes -->
                                <form class="" action="{!! route('frontend.packages.search') !!}" method="get">
                                    <div class="tab-content">
                                        <div role="tabpanel" class="tab-pane active" id="packages">
                                            <div class="row">
                                                <div class="col-xxs-12 col-md-12 mt alternate">
                                                    <div class="input-field">
                                                        <label for="date-start">Package Type:</label>
                                                        <select required name="type" class="form-control search_select">
                                                            <option value="">Choose</option>
                                                            @if ($package_types->count())
                                                                @foreach ($package_types as $type)
                                                                    <option value="{{ $type->slug }}">{{ $type->type }}</option>
                                                                @endforeach
                                                            @endif
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-xxs-12 col-xs-6 mt alternate">
                                                    <div class="input-field">
                                                        <label for="date-start">From:</label>
                                                        <input name="from" type="text" class="form-control" id="date-start" placeholder="mm/dd/yyyy"/>
                                                    </div>
                                                </div>
                                                <div class="col-xxs-12 col-xs-6 mt alternate">
                                                    <div class="input-field">
                                                        <label for="date-end">To:</label>
                                                        <input name="to" type="text" class="form-control" id="date-end" placeholder="mm/dd/yyyy"/>
                                                    </div>
                                                </div>
                                                <div id="app">
                                                    <div class="col-xxs-12 col-md-6 mt alternate">
                                                        <div class="input-field">
                                                            <label for="date-start">Division:</label>
                                                            {{-- <select id='division' name="division" class="form-control search_select" onchange="get_district_in_front(this.value);"> --}}
                                                            <select id='division' name="division" class="form-control search_select" @change="get_district_in_front()" v-model="key">
                                                                <option value="">Choose</option>
                                                                @if ($divisions->count())
                                                                    @foreach ($divisions as $division)
                                                                        <option value="{{ $division->slug }}">{{ $division->name }}</option>
                                                                    @endforeach
                                                                @endif
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-xxs-12 col-md-6 mt alternate">
                                                        <div class="input-field">
                                                            <label for="date-start">District:</label>
                                                            <select name="district" class="form-control search_select" id="district" >
                                                                <option value="">Choose</option>
                                                                <option v-for="d in districts" :value="d.slug">@{{ d.name }}</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-xs-12">
                                                    <input type="submit" class="btn btn-primary btn-block" value="Search Packages">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>

                            </div>
                        </div>
                        <div class="desc2 animate-box">
                            <div class="col-sm-7 col-sm-push-1 col-md-7 col-md-push-1">
                                <h2>WelCome To {{ config('app.name') }}</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div id="fh5co-tours" class="fh5co-section-gray">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2 text-center heading-section animate-box">
                    <h3 class="text-uppercase">Hot Tours</h3>
                    <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
                </div>
            </div>
            <div class="row">
                @if ($top_3_packages->count())
                    @foreach ($top_3_packages as $package)
                        {{-- <div class="col-md-4 col-sm-6 fh5co-tours animate-box" data-animate-effect="fadeIn">
                            <div href=""><img src="{{ $package->places && $package->places[0]->placeImages?$package->places[0]->placeImages[0]->image:'' }}" alt="" class="img-responsive">
                                <div class="desc">
                                    <span></span>
                                    <h3><a style="color: white" href="{!! route('frontend.package.details',$package->slug) !!}">{{ $package->title }}</a></h3>
                                    <span>{{ $package->getInterval()>1? $package->getInterval().' days' : '1 day' }}</span>
                                    <span>{{ $package->departs_date.' to '.$package->return_date }}</span>
                                    <span>Available Seat : {{ $package->availableSeat() }}</span>
                                    <span class="price">${{ $package->cost }} <small style="font-size: 13px">( Per Head )</small> </span>
                                    <a class="btn btn-primary btn-outline" href="{!! route('frontend.package.booking',$package->slug) !!}">Book Now <i class="icon-arrow-right22"></i></a>
                                </div>
                            </div>
                        </div> --}}

                        <div class="col-md-4">
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
                <div style="margin-top:25px" class="col-md-12 text-center animate-box">
                    <p><a class="btn btn-primary btn-outline btn-lg" href="{!! route('frontend.packages') !!}">See All Packages <i class="icon-arrow-right22"></i></a></p>
                </div>
            </div>
        </div>
    </div>

    <div id="fh5co-features">
        <div class="container">
            <div class="row">
                <div class="col-md-4 animate-box">

                    <div class="feature-left">
                        <span class="icon">
                            <i class="icon-hotairballoon"></i>
                        </span>
                        <div class="feature-copy">
                            <h3>Family Travel</h3>
                            <p>Facilis ipsum reprehenderit nemo molestias. Aut cum mollitia reprehenderit.</p>

                        </div>
                    </div>

                </div>

                <div class="col-md-4 animate-box">
                    <div class="feature-left">
                        <span class="icon">
                            <i class="icon-search"></i>
                        </span>
                        <div class="feature-copy">
                            <h3>Couple Plans</h3>
                            <p>Facilis ipsum reprehenderit nemo molestias. Aut cum mollitia reprehenderit.</p>

                        </div>
                    </div>
                </div>
                <div class="col-md-4 animate-box">
                    <div class="feature-left">
                        <span class="icon">
                            <i class="icon-wallet"></i>
                        </span>
                        <div class="feature-copy">
                            <h3>Honeymoon</h3>
                            <p>Facilis ipsum reprehenderit nemo molestias. Aut cum mollitia reprehenderit.</p>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div id="fh5co-destination">
        <div class="tour-fluid">
            <div class="row">
                <div class="col-md-12">
                    <ul id="fh5co-destination-list" class="animate-box">
                        <li class="one-forth text-center" style="background-image: url({!! asset('frontend/images/place-1.jpg') !!}); ">
                            {{-- <a href="#">
                                <div class="case-studies-summary">
                                    <h2>Los Angeles</h2>
                                </div>
                            </a> --}}
                        </li>
                        <li class="one-forth text-center" style="background-image: url({!! asset('frontend/images/place-2.jpg') !!}); ">
                            {{-- <a href="#">
                                <div class="case-studies-summary">
                                    <h2>Hongkong</h2>
                                </div>
                            </a> --}}
                        </li>
                        <li class="one-forth text-center" style="background-image: url({!! asset('frontend/images/place-3.jpg') !!}); ">
                            {{-- <a href="#">
                                <div class="case-studies-summary">
                                    <h2>Italy</h2>
                                </div>
                            </a> --}}
                        </li>
                        <li class="one-forth text-center" style="background-image: url({!! asset('frontend/images/place-4.jpg') !!}); ">
                            {{-- <a href="#">
                                <div class="case-studies-summary">
                                    <h2>Philippines</h2>
                                </div>
                            </a> --}}
                        </li>

                        <li class="one-forth text-center" style="background-image: url({!! asset('frontend/images/place-5.jpg') !!}); ">
                            {{-- <a href="#">
                                <div class="case-studies-summary">
                                    <h2>Japan</h2>
                                </div>
                            </a> --}}
                        </li>
                        <li class="one-half text-center">
                            <div class="title-bg">
                                <div class="case-studies-summary">
                                    <h2>Most Popular Destinations</h2>
                                    <span><a href="{!! route('frontend.places') !!}">View All Destinations</a></span>
                                </div>
                            </div>
                        </li>
                        <li class="one-forth text-center" style="background-image: url({!! asset('frontend/images/place-6.jpg') !!}); ">
                            {{-- <a href="#">
                                <div class="case-studies-summary">
                                    <h2>Paris</h2>
                                </div>
                            </a> --}}
                        </li>
                        <li class="one-forth text-center" style="background-image: url({!! asset('frontend/images/place-7.jpg') !!}); ">
                            {{-- <a href="#">
                                <div class="case-studies-summary">
                                    <h2>Singapore</h2>
                                </div>
                            </a> --}}
                        </li>
                        <li class="one-forth text-center" style="background-image: url({!! asset('frontend/images/place-8.jpg') !!}); ">
                            {{-- <a href="#">
                                <div class="case-studies-summary">
                                    <h2>Madagascar</h2>
                                </div>
                            </a> --}}
                        </li>
                        <li class="one-forth text-center" style="background-image: url({!! asset('frontend/images/place-9.jpg') !!}); ">
                            {{-- <a href="#">
                                <div class="case-studies-summary">
                                    <h2>Egypt</h2>
                                </div>
                            </a> --}}
                        </li>
                        <li class="one-forth text-center" style="background-image: url({!! asset('frontend/images/place-10.jpg') !!}); ">
                            {{-- <a href="#">
                                <div class="case-studies-summary">
                                    <h2>Indonesia</h2>
                                </div>
                            </a> --}}
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div id="fh5co-blog-section" class="fh5co-section-gray">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2 text-center heading-section animate-box">
                    <h3 class="text-uppercase">Places</h3>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row row-bottom-padded-md">
                @if ($top_3_places->count())
                    @foreach ($top_3_places as $place)
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
                <p><a class="btn btn-primary btn-outline btn-lg" href="{!! route('frontend.places') !!}">See All Places <i class="icon-arrow-right22"></i></a></p>
            </div>

        </div>
    </div>
    <!-- fh5co-blog-section -->
    <div id="fh5co-testimonial" style="background-image:url(images/img_bg_1.jpg);">
        <div class="container">
            <div class="row animate-box">
                <div class="col-md-8 col-md-offset-2 text-center fh5co-heading">
                    <h2 class="text-uppercase">Happy Clients</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="box-testimony animate-box">
                        <blockquote>
                            <span class="quote"><span><i class="icon-quotes-right"></i></span></span>
                            <p>&ldquo;Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.&rdquo;</p>
                        </blockquote>
                        <p class="author">John Doe, CEO <a href="" target="_blank">{{ config('app.name') }}</a> <span class="subtext">Creative Director</span></p>
                    </div>

                </div>
                <div class="col-md-4">
                    <div class="box-testimony animate-box">
                        <blockquote>
                            <span class="quote"><span><i class="icon-quotes-right"></i></span></span>
                            <p>&ldquo;Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.&rdquo;</p>
                        </blockquote>
                        <p class="author">John Doe, CEO <a href="" target="_blank">{{ config('app.name') }}</a> <span class="subtext">Creative Director</span></p>
                    </div>


                </div>
                <div class="col-md-4">
                    <div class="box-testimony animate-box">
                        <blockquote>
                            <span class="quote"><span><i class="icon-quotes-right"></i></span></span>
                            <p>&ldquo;Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.&rdquo;</p>
                        </blockquote>
                        <p class="author">John Doe, Founder <a href="">{{ config('app.name') }}</a> <span class="subtext">Creative Director</span></p>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    @include('includes.ajaxScript.location')
@endsection
