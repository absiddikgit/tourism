@extends('layouts.admin')

@section('content')
    <div class="row clearfix">
        <div class="col-md-12">
            <div class="card">
                <div class="header">
                    <h2>User</h2>
                    <ul class="header-dropdown m-r--5">
                        <li class="dropdown">
                            <a class="btn btn-primary" href="{!! route('user.create') !!}">+ Add New</a>
                        </li>
                    </ul>
                </div>
                <div class="body">
                    <div class="">
                        <table class="table table-bordered js-basic-example dataTable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                    <th>User as</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            @php
                                $i = 1
                            @endphp
                            <tbody>
                                @if ($users->count())
                                    @foreach ($users as $u)
                                        <tr>
                                            <td>{{ $i++ }}</td>
                                            <td>{{ $u->name }}</td>
                                            <td>{{ $u->email }}</td>
                                            <td>
                                                @if ($u->status)
                                                    Activated
                                                @else
                                                    Deactivated
                                                @endif
                                            </td>
                                            <td>
                                                @if ($u->is_admin)
                                                    Admin
                                                @else
                                                    Regular user
                                                @endif
                                            </td>
                                            <td>
                                                <div class="dropdown pull-right">
                                                    <button class="btn btn-default dropdown-toggle" type="button" id="menu1" data-toggle="dropdown">Action
                                                        <span class="caret"></span></button>
                                                        <ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
                                                            @if ($u->status)
                                                                <li role="presentation"><a href="{{route('user.deactivated', $u->id)}}"> Deactivate</a></li>
                                                            @else
                                                                <li role="presentation"><a href="{{route('user.activated', $u->id)}}"> Activate</a></li>
                                                            @endif
                                                            <li role="presentation" class="divider"></li>
                                                            <li role="presentation"><a href="{{route('user.edit', $u->id)}}"> Edit</a></li>
                                                            <li><a type="button" data-toggle="modal" data-target="#{{ $u->id }}">Delete</a></li>
                                                        </ul>
                                                    </div>





                                                <form action="{{ route('user.destroy', $u->id) }}" method="post">
                                                    {{ csrf_field() }} {{ method_field('delete') }}



                                                    {{-- some change need
                                                            data-target 1 changed by databse id
                                                            and then id of the next line changed by the same database id
                                                            and must be set form action
                                                    --}}


                                                     {{-- -------------------- delete Pop Up ---------------------------  --}}
                                                    <div class="modal fade" id="{{ $u->id }}" role="dialog">
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
