@extends('layouts.admin')

@section('content')
    <div class="row clearfix">
        <div class="col-md-12">
            <div class="card">
                <div class="header">
                    <h2>Place</h2>
                </div>
                <div class="body">
                    <div class="">
                        <table class="table no-border">
                            <tr>
                                <td>Title</td>
                                <td>:</td>
                                <td>{{ $p->title }}</td>
                            </tr>
                            <tr>
                                <td>division</td>
                                <td>:</td>
                                <td>{{ $p->division->name }}</td>
                            </tr>
                            <tr>
                                <td>district</td>
                                <td>:</td>
                                <td>{{ $p->district->name }}</td>
                            </tr>
                            <tr>
                                <td>Location</td>
                                <td>:</td>
                                <td>{{ $p->location }}</td>
                            </tr>
                            <tr>
                                <td>Description</td>
                                <td>:</td>
                                <td>{!! $p->description !!}</td>
                            </tr>
                            <tr>
                                <td>Images</td>
                                <td>:</td>
                                <td>
                                    @foreach ($p->placeImages as $image)
                                        <div class="col-md-3">
                                            <img width="100%" class="img-thumbnail" src="{{ $image->image }}" alt="">
                                        </div>
                                    @endforeach
                                </td>
                            </tr>
                            <tr>
                                <td>Map</td>
                                <td>:</td>
                                <td>
                                    <iframe width="100%" height="350" frameborder="0" style="border:0" src="https://www.google.com/maps/embed/v1/place?key=AIzaSyDVFg0qp7TwGBUTTzfqBeiTf-CRP_Rc1S8&q={{ $p->location }}" allowfullscreen></iframe>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
