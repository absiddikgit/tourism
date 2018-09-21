@extends('layouts.admin')

@section('content')
    <div class="row clearfix">
        <div class="col-md-12">
            <div class="card">
                <div class="header">
                    <h2>Update Division</h2>
                </div>
                <div class="body">
                    {!! Form::open(['route'=>'places.store','method'=>'post','class'=>'form-horizontal']) !!}
                    @include('includes.errors')

                    <div class="form-group">
                        <label class="col-sm-3 control-label">Title</label>
                        <div class="col-sm-8">
                            <div class="form-line">
                                {!! Form::text('title', null, ['class'=>'form-control','required'=>'']) !!}
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label">Division</label>
                        <div class="col-sm-8">
                            <div class="form-line">
                                {!! Form::select('division', [''=>'choose']+$divisions, 0,
                                    ['class'=>'form-control','required'=>'','onChange'=>"get_district(this.value);"]) !!}
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label">District</label>
                        <div class="col-sm-8">
                            <div class="form-line">
                                <select class="form-control" name="district" id="district">
                                    <option value="">Choose</option>
                                </select>
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
                        <label class="col-sm-3 control-label">Location</label>
                        <div class="col-sm-8">
                            <div class="form-line">
                                {!! Form::text('location', null, ['class'=>'form-control','required'=>'']) !!}
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label">Image</label>
                        <div class="col-sm-8">
                            <div class="">
                                {!! Form::file('image[]', ['multiple'=>'','required'=>'']) !!}
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
@endsection
@section('scripts')
    @include('includes.ajaxScript.location')
@endsection
