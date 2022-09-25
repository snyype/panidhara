
@extends('admin.dashboard')
@section('content')
<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

<style>
    .cell {
  max-width: 30px; /* tweak me please */
  white-space : nowrap;
  overflow : hidden;
}

.expand-small-on-hover:hover {
  max-width : 200px; 
  text-overflow: ellipsis;
}

.expand-maximum-on-hover:hover {
  max-width : initial; 
}
</style>

</head>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="white-box">
                <div class="container">


                    <h3 class="box-title">ALL CURRENT CONECTION REQUESTS</h3>
                    <div class="table-responsive">
                        <table class="table text-nowrap">
                            <thead>
                                <tr>
                                    <th class="border-top-0">S/N</th>
                                    <th class="border-top-0">ID</th>
                                    <th class="border-top-0">User Name</th>
                                    <th class="border-top-0">Name</th>
                                    <th class="border-top-0">Address</th>
                                    <th class="border-top-0">Number</th>
                                    <th class="border-top-0 ">Citizenship No.</th>
                                    <th class="border-top-0">House No.</th>
                                    <th class="border-top-0">Latitude</th>
                                    <th class="border-top-0">Longitude</th>
                                    <th class="border-top-0">Status</th>
                                    <th colspan="3" class="border-top-0">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $post )
                                <tr>
                                    <td>{{$post->id}}</td>
                                    <td>{{$post->user_id}}</td>
                                    <td>{{$post->user_name}}</td>
                                    <td>{{$post->name}}</td>
                                    <td>{{$post->address}}</td>
                                    <td class="cell expand-maximum-on-hover">{{$post->number}}</td>
                                    <td class="cell expand-maximum-on-hover">{{$post->citizenship_number}}</td>
                                    <td>{{$post->house_number}}</td>
                                    <td class="cell expand-maximum-on-hover">{{$post->latitude}}</td>
                                    <td class="cell expand-maximum-on-hover">{{$post->longitude}}</td>
                                    <td>{{$post->status}}</td>
                             
                                   <td> <form method="GET" action="/admin/connectionrequest/{{$post->id}}">
                                        @csrf
                                        <td><input class="btn btn-success" type="submit" value="Confirm This"></td>
                                        </form>
                                        <td><a class="btn btn-success" href="/admin/viewconnectionmap/{{$post->id}}">View Map</a></td>
                                    </td>

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