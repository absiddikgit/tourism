@extends('layouts.frontend')
@section('content')
    <div id="fh5co-contact" class="fh5co-section-gray">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2 text-center heading-section animate-box">
                    <h3>Contact Information</h3>
                </div>
            </div>
            <div class="row animate-box">
                <div class="col-md-6">
                    <h3 class="section-title">Our Address</h3>
                    <ul class="contact-info">
                        <li><i class="icon-location-pin"></i>198 West 21th Street, Suite 721 New York NY 10016</li>
                        <li><i class="icon-phone2"></i>+ 1235 2355 98</li>
                        <li><i class="icon-mail"></i><a href="#">info@yoursite.com</a></li>
                        <li><i class="icon-globe2"></i><a href="#">www.yoursite.com</a></li>
                    </ul>
                </div>
                <div class="col-md-6">
                    <form class="" action="{!! route('frontend.contact.store') !!}" method="post">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input name="name" type="text" value="{{ old('name') }}" class="form-control" placeholder="Name">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input name="email" type="email" value="{{ old('email') }}" class="form-control" placeholder="Email">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <textarea name="message" class="form-control" id="" cols="30" rows="7" placeholder="Message">{{ old('message') }}</textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="submit" value="Send Message" class="btn btn-primary">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
