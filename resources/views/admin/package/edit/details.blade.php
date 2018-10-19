@extends('layouts.admin')

@section('content')
    <div class="row clearfix">
        <div class="col-md-12">
            <div class="card">
                <div class="header">
                    <h2>Update Package Type</h2>
                </div>
                <div class="body">
                    {{Form::model($package,['route'=>['packages.update',$package->id],'method'=>'put','class'=>'form-horizontal'])}}
                    @include('includes.errors')

                        <div class="form-group">
                            <label class="col-sm-3 control-label">Package Title</label>
                            <div class="col-sm-6">
                                <div class="form-line">
                                    {!! Form::text('title', null, ['class'=>'form-control','required'=>'','placeholder'=>'Title']) !!}
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
                            <label class="col-sm-3 control-label">Departs</label>
                            <div class="col-sm-6">
                                <div class="form-line">
                                    {!! Form::text('departs', $package->departs_date, [
                                        'class'=>'form-control',
                                        'autocomplete'=>'off',
                                        'id'=>'departs',
                                        'onChange'=>'dateCheck()',
                                        'value'=>'',
                                        'data-toggle'=>'datepicker',
                                        'placeholder'=>'dd-mm-yyyy',
                                        'required'=>''
                                    ]) !!}
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label">Return</label>
                            <div class="col-sm-6">
                                <div class="form-line">
                                    {!! Form::text('return', $package->return_date, [
                                        'class'=>'form-control',
                                        'autocomplete'=>'off',
                                        'id'=>'return',
                                        'value'=>'',
                                        'onChange'=>'dateCheck()',
                                        'data-toggle'=>'datepicker',
                                        'placeholder'=>'dd-mm-yyyy',
                                        'required'=>''
                                    ]) !!}
                                </div>
                                <small class="text-danger" id='ret_date_error'></small>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label">Booking Deadline</label>
                            <div class="col-sm-6">
                                <div class="form-line">
                                    {!! Form::text('deadline', $package->booking_deadline, [
                                        'class'=>'form-control',
                                        'autocomplete'=>'off',
                                        'value'=>'',
                                        'id'=>'deadline',
                                        'onChange'=>'dateCheck()',
                                        'data-toggle'=>'datepicker',
                                        'placeholder'=>'dd-mm-yyyy',
                                        'required'=>''
                                    ]) !!}
                                </div>
                                <small class="text-danger" id='deadline_date_error'></small>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label">Type</label>
                            <div class="col-sm-6">
                                @if ($package_types)
                                    @foreach ($package_types as $pt)
                                        <div style="padding-top:9px" class="demo-checkbox">
                                            <div class="row">
                                                <div class="col-md-4" style="padding-top:10px">
                                                    <input class="test" {{ $pt->cost?'checked':'' }} onclick="cost_available(this.value)" id="{{ $pt->id }}" value="{{ $pt->id }}" type="checkbox" name="package_types[]">
                                                    <label style="font-size:15px" for="{{ $pt->id }}">{{ $pt->type }}</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="form-line">
                                                        <input id="cost_{{ $pt->id }}" {{ $pt->cost?'':'disabled' }} class="form-control" required type="text" name="package_costs[]" value="{{ $pt->cost != null?$pt->cost:'' }}" placeholder="Cost">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label"></label>
                            <div class="col-sm-6">
                                <div class="pull-right">
                                    {{Form::submit('Save',['class'=>'btn btn-success'])}}
                                </div>
                            </div>
                        </div>

                    {{Form::close()}}
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    @include('includes.ajaxScript.location')
    @include('includes.ajaxScript.place')
    @include('includes.ajaxScript.hotel')
    @include('includes.ajaxScript.package')
    <script>
        function cost_available(value) {
            if ($('#'+value).is(":checked")) {
                $('#cost_'+value).removeAttr('disabled');
                $('.test').removeAttr('required');
            }else {
                $('#cost_'+value).prop('disabled',true);
            }
        }
        window.onload = function() {
            if ($('.test').is(":checked")) {
                $('.test').removeAttr('required');
            }
        }
    </script>
@endsection
