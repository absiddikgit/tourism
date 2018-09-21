@extends('layouts.admin')

@section('content')
    <div class="row clearfix">
        <div class="col-md-6">
            <div class="card">
                <div class="header">
                    <h2>Create Division</h2>
                </div>
                <div class="body">
                    {{Form::open(['route'=>'divisions.store','method'=>'post','class'=>'form-horizontal'])}}
                    @include('includes.errors')

                    <div class="form-group">
                        <label class="col-sm-3 control-label">Division</label>
                        <div class="col-sm-6">
                            <div class="form-line">
                                {{Form::text('division',null,['class'=>'form-control','required'=>'','placeholder'=>'Division name'])}}
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
        <div class="col-md-6">
            <div class="card">
                <div class="header">
                    <h2>Division</h2>
                </div>
                <div class="body">
                    <div class="">
                        <table class="table table-bordered js-basic-example dataTable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Division Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            @php
                            $i = 1
                            @endphp
                            <tbody>
                                @if ($divisions->count())
                                    @foreach ($divisions as $d)
                                        <tr>
                                            <td>{{ $i++ }}</td>
                                            <td>{{ $d->name }}</td>
                                            <td>
                                                <a class="btn btn-sm btn-primary" href="{{route('divisions.edit', $d->id)}}"> Edit</a>
                                                <a class="btn btn-sm btn-danger" type="button" data-toggle="modal" data-target="#{{ $d->id }}">Delete</a>

                                                <form action="{{ route('divisions.destroy', $d->id) }}" method="post">
                                                    {{ csrf_field() }} {{ method_field('delete') }}



                                                    {{-- some change need
                                                    data-target 1 changed by databse id
                                                    and then id of the next line changed by the same database id
                                                    and must be set form action
                                                    --}}


                                                    {{-- -------------------- delete Pop Up ---------------------------  --}}
                                                    <div class="modal fade" id="{{ $d->id }}" role="dialog">
                                                        @include('includes.delete')
                                                    </div>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td></td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
