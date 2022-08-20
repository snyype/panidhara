
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
  <form action="/admin/carousel/{{$data->id}}" method="POST" enctype='multipart/form-data'>
    <div class="form-group">
        @csrf
        
      <label for="exampleInputEmail1">Name</label>
      <input type="text" class="form-control"   placeholder="Carousel Title" name="name" value="{{$data->name}}">
      
    </div>
    <div class="form-group">
      <label for="exampleInputPassword1">Description</label>
      <input type="text" class="form-control" placeholder="Enter Desc." name="desc" value="{{$data->desc}}">
    </div>
    <div class="form-group">
      <label for="exampleInputPassword1">Current Image of {{$data->name}} :<br>@if($data['image']=='image.png')  <p> Sorry no image found.</p> @else <span><img style='width: 200px;height:130px' src='{{asset("/images/carousel/".$data["gallery"])}}'/></span>@endif</label>
      
    </div>
    <div class="form-group">
      <label for="exampleInputPassword1">Image</label>
      <input type="file" class="form-control" value="{{asset("/images/carousel/".$data["gallery"])}}"   name="gallery">
    </div>
    <br>
      
    <button type="submit" class="btn btn-primary">Update Carousel</button>
  </form>
      </div>
      </div>
    </div>
  </div>
</div>
@endsection