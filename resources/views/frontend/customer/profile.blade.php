@extends('layouts.frontend')
@section('styles')
    <style media="screen">
        .f-label{
            font-weight: unset !important;
        }
    </style>
@endsection
@section('content')
    <div style="padding-top:2em" id="fh5co-tours" class="fh5co-section-gray">
        <div class="container-fluid">
            <div class="col-md-10 col-md-offset-1">
                <div class="col-md-3">
                    @include('includes.customer.left_bar')
                </div>
                <div class="col-md-9">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 style="margin: 10px">Profile</h3>
                        </div>
                        <div class="panel-body">
                            <form style="padding-top:20px" class="" action="{!! route('customer.profile.store') !!}" method="post">
                                {{ csrf_field() }}
                                @include('includes.errors')
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="f-label" for="">Name *</label>
                                        <input type="text" class="form-control" name="name"  placeholder="Name" value="{{ $user->name?$user->name:old('name') }}" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="f-label" for="">Contact Number *</label>
                                        <input type="text" class="form-control" name="contact_number"  placeholder="Contact Number" value="{{ $user && $user->customerInfo?$user->customerInfo->contact_number:old('contact_number') }}" required>
                                    </div>
                                </div>
                                <div style="padding-top: 20px" class="col-md-12">
                                    <h3>Address</h3>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="f-label" for="">Country *</label>
                                        <input type="text" class="form-control" name="country"  placeholder="Country" value="{{ $user && $user->customerInfo?$user->customerInfo->country:old('country') }}" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="f-label" for="">Address *</label>
                                        <input type="text" class="form-control" name="address"  placeholder="Address" value="{{ $user && $user->customerInfo?$user->customerInfo->address:old('address') }}" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="f-label" for="">City *</label>
                                        <input type="text" class="form-control" name="city"  placeholder="City" value="{{ $user && $user->customerInfo?$user->customerInfo->city:old('city') }}" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="f-label" for="">Postcode *</label>
                                        <input type="text" class="form-control" name="postcode"  placeholder="Postcode" value="{{ $user && $user->customerInfo?$user->customerInfo->postcode:old('postcode') }}" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="f-label" for="">NID / Passport *</label>
                                        <input type="text" class="form-control" name="NID"  placeholder="NID / Passport" value="{{ $user && $user->customerInfo?$user->customerInfo->NID:old('NID') }}" required>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group pull-right">
                                        <label class="f-label" for=""></label>
                                        <input type="submit" class="btn btn-primary">
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
