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
                        <li class="active"><a>Details</a></li>
                        <li><a href="{!! route('hotel.location.edit',$hotel->id) !!}">Location</a></li>
                        <li><a href="{!! route('hotel.images.edit',$hotel->id) !!}">Images</a></li>
                    </ul>

                    <div class="tab-content">
                        <div id="home" class="tab-pane fade in active">
                            {!! Form::model($hotel,['route'=>['hotels.update',$hotel->id],'method'=>'put','class'=>'form-horizontal','enctype'=> 'multipart/form-data']) !!}
                            @include('includes.errors')

                            <div class="form-group">
                                <label class="col-sm-3 control-label">Name</label>
                                <div class="col-sm-8">
                                    <div class="form-line">
                                        {!! Form::text('name', null, ['class'=>'form-control','required'=>'']) !!}
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label">Description</label>
                                <div class="col-sm-8">
                                    <div class="form-line">
                                        {!! Form::textarea('description', null, ['class'=>'form-control','required'=>'','id'=>"ckeditor"]) !!}
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
