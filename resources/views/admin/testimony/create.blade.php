@extends('admin.dashboard')
@section('content')
    


<div class="container-fluid">
  <div class="row">
    <div class="col-sm-12">
      <div class="white-box">
        @if (session('status'))
    <div class="alert alert-danger">
        {{ session('status') }}
    </div>
@endif
        <div class="container">
  <form action="/admin/testimony" method="POST" enctype='multipart/form-data'>
    <div class="form-group">
        @csrf
        
      <label for="exampleInputEmail1">Name</label>
      <input type="text" class="form-control"   placeholder="Name" name="name">
      
    </div>
    <div class="form-group">
      <label for="exampleInputPassword1">Description</label>
      <input type="text" class="form-control" placeholder="Enter Desc." name="desc">
    </div>
    <div class="form-group">
      <label for="exampleInputPassword1">Subject</label>
      <input type="text" class="form-control"  placeholder="Enter Subject"  name="subject" required>
    </div>
    <br>
    <div class="form-group">
        <label for="exampleInputPassword1">Image</label>
        <input type="file" class="form-control"   name="image" required>
      </div>
      <br>
      
    <button type="submit" class="btn btn-primary">Create Testimony</button>
  </form>
  <form action="/admin/carousel">
    <div style="margin-top:10px"><button type="submit" style="width: 128px" class="btn btn-danger text-white">Cancel</button></a></div>
  </div></form>
      </div>
      </div>
    </div>
  </div>
</div>
@endsection