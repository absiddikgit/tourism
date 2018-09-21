@extends('layouts.admin')

@section('content')
    <div class="row clearfix">
        <div class="col-md-12">
            <div class="card">
                <div class="header">
                    <h2>Update Division</h2>
                </div>
                <div class="body">
                    {{Form::model($division,['route'=>['divisions.update',$division->id],'method'=>'put','class'=>'form-horizontal'])}}
                    @include('includes.errors')

                    <div class="form-group">
                        <label class="col-sm-3 control-label">Division</label>
                        <div class="col-sm-6">
                            <div class="form-line">
                                {{Form::text('division',$division->name,['class'=>'form-control','required'=>'','placeholder'=>'Division name'])}}
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
