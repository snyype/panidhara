
@extends('admin.dashboard')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="white-box">
                <div class="container">


                    <h3 class="box-title">MAINTANANCE REQUESTS</h3>
                    <div class="table-responsive">
                        <table class="table text-nowrap">
                            <thead>
                                <tr>
                                    <th class="border-top-0">S/N</th>
                                    <th class="border-top-0">User ID</th>
                                    <th class="border-top-0">User Name</th>
                                    <th class="border-top-0">Comment</th>
                                    <th class="border-top-0">House No.</th>
                                    <th class="border-top-0">Latitide</th>
                                    <th class="border-top-0">Longitude</th>
                                    <th class="border-top-0">Date For field visit</th>
                                    <th colspan="3" class="border-top-0">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $post )
                                <tr>
                                    <td>{{$post->id}}</td>
                                    <td>{{$post->user_id}}</td>
                                    <td>{{$post->user_name}}</td>
                                    <td>{{$post->comment}}</td>
                                    <td>{{$post->house_number}}</td>
                                    <td>{{$post->latitude}}</td>
                                    <td>{{$post->longitude}}</td>
                                    <td>{{$post->date}}</td>
                                    <td><a href="/admin/viewmap/{{$post->id}}"><button class="btn btn-success">View Map</button></a></td>
                             
                                   
                                </tr>
                               @endforeach
                            </tbody>
                        </table>
                        
                    </div><br><br>


</div>
            </div>
        </div>
    </div>
</div>


@endsection