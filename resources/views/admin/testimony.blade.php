@extends('admin.dashboard')
@section('content')



            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="white-box">
                           
                            <script>

$( "#clickme" ).click(function() {
  $( "#clickme" ).fadeOut( "slow", function() {
    // Animation complete.
  });
}); </script>
 @if (session('status'))
    <div class="alert alert-success" id="clickme" >
        {{ session('status') }}
    </div>
@endif
                            <h3 class="box-title">Carousel</h3>
                            <div class="table-responsive">
                                <table class="table text-nowrap">
                                    <thead>
                                        <tr>
                                            <th class="border-top-0">ID</th>
                                            <th class="border-top-0">Name</th>
                                            <th class="border-top-0">Description</th>
                                            <th class="border-top-0">Subject</th>
                                            <th class="border-top-0">Status</th>
                                            <th class="border-top-0">Image</th>
                                            <th colspan="3" class="border-top-0">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $post )
                                        <tr>
                                            <td>{{$post->id}}</td>
                                            <td>{{$post->name}}</td>
                                            <td>View Desc in edit page</td>
                                            <td>{{$post->subject}}</td>
                                            <td>{{$post->status}}</td>
                                            <td><img style='width: 250px;height:90px' src='{{asset("/images/testimony/".$post["image"])}}'/></td>
                                            <td style="width: 40px;"><a href="/admin/testimony/{{$post->id}}/edit"><button class="btn btn-success">Update</button></a></td>
                                            <form method="POST" action="/admin/testimony/{{$post->id}}">
                                                @csrf
                                                @method('delete')
                                                <td><input class="btn btn-danger" type="submit" value="Delete"></td>
                                                </form>
                                        </tr>
                                       @endforeach
                                    </tbody>
                                </table>
                                <form method="GET" action="/admin/testimony/create">
   
                                    <input class="btn btn-primary" type="submit" value="Add Testimony">
                                    </form>
                               
                            </div>
                        </div>
                    </div>
                </div>
              
            </div>
    
    
   
    
   @endsection