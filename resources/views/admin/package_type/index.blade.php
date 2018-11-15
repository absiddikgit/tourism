@extends('layouts.admin')

@section('content')
    <div class="row clearfix">
        <div class="col-md-12">
            <div class="card">
                <div class="header">
                    <h2>Package Type</h2>
                    <ul class="header-dropdown m-r--5">
                        <li class="dropdown">
                            <a class="btn btn-primary" href="{!! route('package-types.create') !!}">+ Add New</a>
                        </li>
                    </ul>
                </div>
                <div class="body">
                    <div class="">
                        <table class="table table-bordered js-basic-example dataTable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Type</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            @php
                            $i = 1
                            @endphp
                            <tbody>
                                @if ($package_types->count())
                                    @foreach ($package_types as $pt)
                                        <tr>
                                            <td>{{ $i++ }}</td>
                                            <td>{{ $pt->type }}</td>
                                            <td>
                                                <a class="btn btn-sm btn-primary" href="{{route('package-types.edit', $pt->id)}}"> Edit</a>
                                                <a class="btn btn-sm btn-danger" type="button" data-toggle="modal" data-target="#{{ $pt->id }}">Delete</a>

                                                <form action="{{ route('package-types.destroy', $pt->id) }}" method="post">
                                                    {{ csrf_field() }} {{ method_field('delete') }}



                                                    {{-- some change need
                                                    data-target 1 changed by databse id
                                                    and then id of the next line changed by the same database id
                                                    and must be set form action
                                                    --}}


                                                    {{-- -------------------- delete Pop Up ---------------------------  --}}
                                                    <div class="modal fade" id="{{ $pt->id }}" role="dialog">
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
