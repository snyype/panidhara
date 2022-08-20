@php
    $user=auth()->user();
@endphp

@extends('admin.dashboard')
@section('content')
    
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="white-box">
{{-- @if (session('status'))
    <div class="alert alert-danger">
        {{ session('status') }}
    </div>
@endif
    <div class="container">
    <form action="/userstable/{{$data->id}}" method="POST">
        @csrf
        @error('title')
        <div class="alert alert-danger">Please enter the title</div>
        @enderror

        Name:<input type="text" name="name" value="{{$data->name}}"><br>
        Email: <input type="email" name="email" value="{{$data->email}}"><br>
        Role: <input type="text" name="role" value="{{$data->role}}"><br>
        <button class="btn btn-success">Edit Post</button>
    </form>
    </div> --}}

    @if (session('status'))
    <div class="alert alert-danger">
        {{ session('status') }}
    </div>
@endif
    <div class="container">
  
    <form action="/admin/userstable/{{$data->id}}" method="POST" enctype='multipart/form-data'>
        <div class="form-group">
           @csrf
          <label for="exampleInputEmail1">Name</label>
          <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"  name="name" value="{{$data->name}}">
          
        </div>
        <div class="form-group">
          <label for="exampleInputPassword1">Email</label>
          <input type="email" class="form-control" id="exampleInputPassword1"  name="email" value="{{$data->email}}">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Role</label>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="role" id="flexRadioDefault1" <?php if($data['role']=="2") {echo "checked";}?> value="2"  >
                <label class="form-check-label" for="flexRadioDefault1">
                  Admin 
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="role" id="flexRadioDefault2" <?php if($data['role']=="1") {echo "checked";}?> value="1"  >
                <label class="form-check-label" for="flexRadioDefault2">
                  User
                </label>
              </div>
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Verification</label>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="verified"  <?php if($data['verified']=="2") {echo "checked";}?> value="2"  >
                <label  for="flexRadioDefault1">
                  Verified 
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="verified"  <?php if($data['verified']=="1") {echo "checked";}?> value="1"  >
                <label  for="flexRadioDefault2">
                  Not Verified
                </label>
              </div>
          </div>

         
        <button type="submit" class="btn btn-success">Update User</button>
      </form>
      <div style="margin-top:10px"><a href="/admin/userstable"><button type="submit" style="width: 104px" class="btn btn-danger">Cancel</button></a></div>
    </div>



        </div>
        </div>
    </div>
</div>
    @endsection