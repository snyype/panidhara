@extends('admin.dashboard')
@section('content')




            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="white-box">
                            @if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif
                            <h3 class="box-title">Registred Users</h3>
                            <div class="table-responsive">
                                <table class="table text-nowrap">
                                    <thead>
                                        <tr>
                                            <th class="border-top-0">ID</th>
                                            <th class="border-top-0">Name</th>
                                            <th class="border-top-0">Email</th>
                                            <th class="border-top-0">Verification</th>
                                            <th class="border-top-0">Role</th>
                                            <th colspan="3" class="border-top-0">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $post )
                                        <tr>
                                            <td>{{$post->id}}</td>
                                            <td>{{$post->name}}@if($post['verified']=='2')<span><img style='width: 30px;height:30px' title="Verified" src='{{asset("/images/badges/admin.png")}}'/></span>@endif</td>
                                            <td>{{$post->email}}</td>
                                            <td><?php if($post['verified']=="2") {echo "Verified";} else {echo "not verified";}?></td>
                                            <td><?php if($post['role']=="2") {echo "Admin";} else {echo "User";}?></td>
                                            <td style="width: 40px;"><a href="/admin/userstable/{{$post->id}}/edit"><button class="btn btn-success">Update</button></a></td>
                                            <form method="POST" action="/admin/userstable/{{$post->id}}">
                                                @csrf
                                                @method('delete')
                                                <td><input class="btn btn-danger" type="submit" value="Delete"></td>
                                                </form>
                                        </tr>
                                       @endforeach
                                    </tbody>
                                </table>
                                <a href="/admin/userstable/create" class="btn btn-primary" >Create User</a>
                            </div>
                        </div>
                    </div>
                </div>
           
            </div>
          
        </div>
        
    </div>
   @endsection