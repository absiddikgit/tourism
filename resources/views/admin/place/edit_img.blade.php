@extends('layouts.admin')

@section('content')
    <div class="row clearfix">
        <div class="col-md-12">
            <div class="card">
                <div class="header">
                    <h2>Update Place</h2>
                </div>
                <div class="body">
                    <ul class="nav nav-tabs">
                        <li><a href="{!! route('places.edit',$p->id) !!}">Details</a></li>
                        <li><a href="{!! route('place.location.edit',$p->id) !!}">Location</a></li>
                        <li class="active"><a>Images</a></li>
                    </ul>

                    <div class="tab-content">
                        <div id="menu1">
                            {!! Form::model($p,['route'=>['place.images.update',$p->id],'method'=>'post','class'=>'form-horizontal','enctype'=> 'multipart/form-data']) !!}
                            @include('includes.errors')

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
            <div class="card">
                <div style="overflow:hidden" class="body">
                    <div class="">
                        @foreach ($p->placeImages as $image)
                            <div class="col-md-3">
                                <div class="img-thumbnail">
                                    <img width="100%" src="{{ $image->image }}" alt="">
                                    <div style="padding-top: 10px;" class="pull-right">
                                        <a class="btn btn-sm btn-danger" type="button" data-toggle="modal" data-target="#{{ $image->id }}"> <i class="material-icons">delete</i> </a>
                                        <form action="{{ route('place.images.delete', $image->id) }}" method="post">
                                            {{ csrf_field() }} {{ method_field('delete') }}



                                            {{-- some change need
                                            data-target 1 changed by databse id
                                            and then id of the next line changed by the same database id
                                            and must be set form action
                                            --}}


                                            {{-- -------------------- delete Pop Up ---------------------------  --}}
                                            <div class="modal fade" id="{{ $image->id }}" role="dialog">
                                                @include('includes.delete')
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    @include('includes.ajaxScript.location')
@endsection
