@extends('layouts.admin')
@section('content')
    <div class="row clearfix">
        <div class="col-md-12">
            <div class="card">
                <div class="header">
                    <h2>Customer List</h2>
                </div>
                <div class="body">
                    <div class="">
                        <table class="table table-bordered js-basic-example dataTable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Address</th>
                                    <th>Contact Number</th>
                                    <th>City</th>
                                    <th>Country</th>
                                    <th>Postcode</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            @php
                            $i = 1
                            @endphp
                            <tbody>
                                @if ($customers->count())
                                    @foreach ($customers as $c)
                                        <tr>
                                            <td>{{ $i++ }}</td>
                                            <td>{{ $c->name }}</td>
                                            <td>{{ $c->email }}</td>
                                            <td>{{ $c->customerInfo->address }}</td>
                                            <td>{{ $c->customerInfo->contact_number }}</td>
                                            <td>{{ $c->customerInfo->city }}</td>
                                            <td>{{ $c->customerInfo->country }}</td>
                                            <td>{{ $c->customerInfo->postcode }}</td>
                                            <td>
                                                <a class="btn btn-sm btn-danger" type="button" data-toggle="modal" data-target="#{{ $c->id }}">Delete</a>

                                                <form action="{{ route('customers.destroy',$c->id) }}" method="post">
                                                    {{ csrf_field() }} {{ method_field('delete') }}



                                                    {{-- some change need
                                                    data-target 1 changed by databse id
                                                    and then id of the next line changed by the same database id
                                                    and must be set form action
                                                    --}}


                                                    {{-- -------------------- delete Pop Up ---------------------------  --}}
                                                    <div class="modal fade" id="{{ $c->id }}" role="dialog">
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
