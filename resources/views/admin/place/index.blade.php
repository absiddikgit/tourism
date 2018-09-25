@extends('layouts.admin')

@section('content')
    <div class="row clearfix">
        <div class="col-md-12">
            <div class="card">
                <div class="header">
                    <h2>Place</h2>
                    <ul class="header-dropdown m-r--5">
                        <li class="dropdown">
                            <a class="btn btn-primary" href="{!! route('places.create') !!}">+ Add New</a>
                        </li>
                    </ul>
                </div>
                <div class="body">
                    <div class="">
                        <table class="table table-bordered js-basic-example dataTable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Image</th>
                                    <th>Title</th>
                                    <th>District Name</th>
                                    <th>Division Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            @php
                            $i = 1
                            @endphp
                            <tbody>
                                @if ($places->count())
                                    @foreach ($places as $p)
                                        <tr>
                                            <td>{{ $i++ }}</td>
                                            <td>
                                                @if ($p->placeImages->count())
                                                    <img width="70px" height="35px" src="{{ $p->placeImages[0]->image }}" alt="">
                                                @endif
                                            </td>
                                            <td>{{ $p->title }}</td>
                                            <td>{{ $p->district->name }}</td>
                                            <td>{{ $p->division->name }}</td>
                                            <td>
                                                <a class="btn btn-sm btn-info" href="{{route('places.show', $p->id)}}"> view</a>
                                                <a class="btn btn-sm btn-primary" href="{{route('places.edit', $p->id)}}"> Edit</a>
                                                <a class="btn btn-sm btn-danger" type="button" data-toggle="modal" data-target="#{{ $p->id }}">Delete</a>

                                                <form action="{{ route('places.destroy', $p->id) }}" method="post">
                                                    {{ csrf_field() }} {{ method_field('delete') }}



                                                    {{-- some change need
                                                    data-target 1 changed by databse id
                                                    and then id of the next line changed by the same database id
                                                    and must be set form action
                                                    --}}


                                                    {{-- -------------------- delete Pop Up ---------------------------  --}}
                                                    <div class="modal fade" id="{{ $p->id }}" role="dialog">
                                                        @include('includes.delete')
                                                    </div>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
