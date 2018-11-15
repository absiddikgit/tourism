@extends('layouts.admin')

@section('content')
    <div class="row clearfix">
        <div class="col-md-12">
            <div class="card">
                <div class="header">
                    <h2>Package</h2>
                    <ul class="header-dropdown m-r--5">
                        <li class="dropdown">
                            <a class="btn btn-primary" href="{!! route('packages.create') !!}">+ Add New</a>
                        </li>
                    </ul>
                </div>
                <div class="body">
                    <div class="">
                        <table class="table table-bordered js-basic-example dataTable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Title</th>
                                    <th>Division</th>
                                    <th>District</th>
                                    <th>Departs Date</th>
                                    <th>Return Date</th>
                                    <th>Deadline Date</th>
                                    <th>Total Seat</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            @php
                            $i = 1
                            @endphp
                            <tbody>
                                @if ($packages->count())
                                    @foreach ($packages as $p)
                                        <tr>
                                            <td>{{ $i++ }}</td>
                                            <td>{{ $p->title }}</td>
                                            <td>{{ $p->division->name }}</td>
                                            <td>{{ $p->district->name }}</td>
                                            <td>{{ $p->departs_date }}</td>
                                            <td>{{ $p->return_date }}</td>
                                            <td>{{ $p->booking_deadline }}</td>
                                            <td>{{ $p->total_seat }}</td>
                                            <td>{{ $p->status }}</td>
                                            <td>
                                                <a class="btn btn-sm btn-info" href="{{route('packages.show', $p->id)}}"> Show</a>
                                                @if ($p->getOriginal('status'))
                                                    <a class="btn btn-xm btn-danger" href="{!! route('packages.is_active',$p->id) !!}">Deactive</a>
                                                @else
                                                    <a class="btn btn-xm btn-success" href="{!! route('packages.is_active',$p->id) !!}">Active</a>
                                                @endif
                                                <a class="btn btn-sm btn-danger" type="button" data-toggle="modal" data-target="#{{ $p->id }}">Delete</a>

                                                <form action="{{ route('packages.destroy', $p->id) }}" method="post">
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
