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
                                            <th class="border-top-0">Image</th>
                                            <th colspan="3" class="border-top-0">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $post )
                                        <tr>
                                            <td>{{$post->id}}</td>
                                            <td>{{$post->name}}</td>
                                            <td>{{$post->desc}}</td>
                                            <td><img style='width: 250px;height:90px' src='{{asset("/images/carousel/".$post["gallery"])}}'/></td>
                                            <td style="width: 40px;"><a href="/admin/carousel/{{$post->id}}/edit"><button class="btn btn-success">Update</button></a></td>
                                            <form method="POST" action="/admin/carousel/{{$post->id}}">
                                                @csrf
                                                @method('delete')
                                                <td><input class="btn btn-danger" type="submit" value="Delete"></td>
                                                </form>
                                        </tr>
                                       @endforeach
                                    </tbody>
                                </table>
                                <form method="GET" action="/admin/carousel/create">
   
                                    <input class="btn btn-primary" type="submit" value="Add Carousel">
                                    </form>
                               
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Right sidebar -->
                <!-- ============================================================== -->
                <!-- .right-sidebar -->
                <!-- ============================================================== -->
                <!-- End Right sidebar -->
                <!-- ============================================================== -->
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            
            <!-- ============================================================== -->
            <!-- End footer -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
    </div>
   
    
   @endsection