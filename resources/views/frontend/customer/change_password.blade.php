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
                            <h3 style="margin: 10px">Change Password</h3>
                        </div>
                        <div class="panel-body">
                            <form style="padding-top:20px" class="" action="{!! route('customer.change-password.store') !!}" method="post">
                                {{ csrf_field() }}

                                @include('includes.errors')
                                <div class="col-md-12">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="f-label" for="">Old Password*</label>
                                            <input type="password" class="form-control" name="old_password"  placeholder="Old Password" value="{{ old('old_password') }}" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="f-label" for="">New Password *</label>
                                            <input type="password" class="form-control" name="password"  placeholder="New Password" value="{{ old('password') }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="f-label" for="">Retype New Password *</label>
                                            <input type="password" class="form-control" name="password_confirmation"  placeholder="Retype New Password" value="{{ old('password_confirmation') }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group pull-right">
                                            <label class="f-label" for=""></label>
                                            <input type="submit" class="btn btn-primary">
                                        </div>
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
