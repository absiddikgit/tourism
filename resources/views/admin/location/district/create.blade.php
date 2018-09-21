@extends('layouts.admin')

@section('content')
    <div class="row clearfix">
        <div class="col-md-12">
            <div class="card">
                <div class="header">
                    <h2>Create District</h2>
                </div>
                <div class="body">
                    {{Form::open(['route'=>'districts.store','method'=>'post','class'=>'form-horizontal'])}}
                    @include('includes.errors')

                    <div class="form-group">
                        <label class="col-sm-3 control-label">Division</label>
                        <div class="col-sm-6">
                            <div class="form-line">
                                {!! Form::select('division', [''=>'choose']+$divisions, 0, ['class'=>'form-control','required'=>'']) !!}
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label">District</label>
                        <div class="col-sm-6">
                            <div class="form-line">
                                {{Form::text('district',null,['class'=>'form-control','required'=>'','placeholder'=>'District name'])}}
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label"></label>
                        <div class="col-sm-6">
                            <div class="pull-right">
                                {{Form::submit('Save',['class'=>'btn btn-success'])}}
                                <input class="btn btn-danger" type="reset" value="Reset">
                            </div>
                        </div>
                    </div>

                    {{Form::close()}}
                </div>
            </div>
        </div>
    </div>
@endsection
