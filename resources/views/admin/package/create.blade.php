@extends('layouts.admin')

@section('content')
    <div class="row clearfix">
        <div class="col-md-12">
            <div class="card">
                <div class="header">
                    <h2>Create Package</h2>
                </div>
                <div class="body">
                    {{Form::open(['route'=>'packages.store','method'=>'post','class'=>'my_form','id'=>'wizard_with_validation'])}}
                        @include('includes.errors')

                        <h3>Location</h3>
                        <fieldset>
                            <div class="form-horizontal">
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Division</label>
                                    <div class="col-sm-6">
                                        <div class="form-line">
                                            {!! Form::select('division', [''=>'choose']+$divisions, 0,
                                                ['class'=>'form-control','required'=>'','id'=>'division','onChange'=>"get_district(this.value);"]) !!}
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label">District</label>
                                    <div class="col-sm-6">
                                        <div class="form-line">
                                            <select class="form-control" required name="district" id="district" onChange="get_places(this.value);get_hotels(this.value);">
                                                <option value="">Choose</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </fieldset>

                        <h3>Place</h3>
                        <fieldset>
                            <div class="" id="place"></div>
                        </fieldset>

                        <h3>Hotel</h3>
                        <fieldset>
                            <div class="" id="hotel"></div>
                        </fieldset>

                        <h3>Details</h3>
                        <fieldset>
                            <div class="form-horizontal">
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Departs</label>
                                    <div class="col-sm-6">
                                        <div class="form-line">
                                            {!! Form::text('departs', null, [
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
                                            {!! Form::text('return', null, [
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
                                            {!! Form::text('deadline', null, [
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
                                            @foreach ($package_types as $id => $type)
                                                <div style="padding-top:9px" class="demo-checkbox">
                                                    <div class="row">
                                                        <div class="col-md-4" style="padding-top:10px">
                                                            <input onclick="cost_available(this.value)" id="{{ $id }}" value="{{ $id }}" type="checkbox" required name="package_types[]">
                                                            <label style="font-size:15px" for="{{ $id }}">{{ $type }}</label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <div class="form-line">
                                                                <input id="cost_{{ $id }}" disabled class="form-control" required type="text" name="package_costs[]" value="" placeholder="Cost">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Status</label>
                                    <div class="col-sm-6">
                                        <div class="form-line">
                                            {!! Form::select('status',$status, null, ['class'=>'form-control','required'=>'']) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </fieldset>

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
            $('#cost_'+value).removeAttr('disabled');
        }
    </script>
@endsection
