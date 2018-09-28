@extends('layouts.admin')

@section('content')
    <div class="row clearfix">
        <div class="col-md-12">
            <div class="card">
                <div class="header">
                    <h2>Update Hotel</h2>
                </div>
                <div class="body">
                    <ul class="nav nav-tabs">
                        <li><a href="{!! route('hotels.edit',$hotel->id) !!}">Details</a></li>
                        <li class="active"><a>Location</a></li>
                        <li><a href="{!! route('hotel.images.edit',$hotel->id) !!}">Images</a></li>
                    </ul>

                    <div class="tab-content">
                        <div id="home" class="tab-pane fade in active">
                            {!! Form::model($hotel,['route'=>['hotel.location.update',$hotel->id],'method'=>'put','class'=>'form-horizontal','enctype'=> 'multipart/form-data']) !!}
                            @include('includes.errors')

                            <div class="form-group">
                                <label class="col-sm-3 control-label">Division</label>
                                <div class="col-sm-8">
                                    <div style="margin-bottom:3px;" class="form-line">
                                        {!! Form::select('division', [''=>'choose']+$divisions, 0,
                                            ['class'=>'form-control','onChange'=>"get_district(this.value);"]) !!}
                                    </div>
                                    <i><small>Previous Division: {{ $hotel->division->name }}</small></i>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label">District</label>
                                <div class="col-sm-8">
                                    <div style="margin-bottom:3px;" class="form-line">
                                        <select class="form-control" name="district" id="district">
                                            <option value="">Choose</option>
                                        </select>
                                    </div>
                                    <i><small>Previous District: {{ $hotel->district->name }}</small></i>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Location</label>
                                <div class="col-sm-8">
                                    <div class="form-line">
                                        {!! Form::text('location', null, ['class'=>'form-control','required'=>'']) !!}
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label"></label>
                                <div class="col-sm-8">
                                    <div class="pull-right">
                                        {!! Form::submit('Save',['class'=>'btn btn-success']) !!}
                                        <input class="btn btn-danger" type="reset" value="Reset">
                                    </div>
                                </div>
                            </div>

                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    @include('includes.ajaxScript.location')
@endsection
