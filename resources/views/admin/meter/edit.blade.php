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
  
    <form action="/admin/tanker/{{$data->id}}" method="POST" enctype='multipart/form-data'>
        <div class="form-group">
           
            @csrf
          <label for="exampleInputEmail1">Name</label>
          <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"  name="name" value="{{$data->name}}">
          
        </div>
        <div class="form-group">
          <label for="exampleInputPassword1">Description</label>
          <input type="text" class="form-control" id="exampleInputPassword1"  name="desc" value="{{$data->desc}}">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Price</label>
            <input type="number" class="form-control" id="exampleInputPassword1"  name="price" value="{{$data->price}}">
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Capacity</label>
            <input type="number" class="form-control" id="exampleInputPassword1"  name="capacity" value="{{$data->capacity}}">
          </div><br>
          <div class="form-group">
            <label for="exampleInputPassword1">Capacity</label>
            <input type="text" class="form-control" id="exampleInputPassword1"  name="water_source" value="{{$data->water_source}}">
          </div><br>
          <div class="form-group">
            <label for="exampleInputPassword1">Status</label>
            <input type="text" class="form-control" id="exampleInputPassword1"  name="status" value="{{$data->status}}">
          </div><br>
          <div class="form-group">
            <label for="exampleInputPassword1">Current Image of  {{$data->name}} :<br>@if($data['image']=='image.png')  <p> Sorry no image found.</p> @else <span><img style='width: 200px;height:130px' src='{{asset("/images/tanker/".$data["image"])}}'/></span>@endif</label>
            <input type="file" class="form-control" name="image">
          </div><br>
        <button type="submit" class="btn btn-success">Update Tanker</button>
      </form>
      <form action="/admin/tanker">
      <div style="margin-top:10px"><button type="submit" style="width: 116px" class="btn btn-danger">Cancel</button></a></div>
    </div></form>
      
    </div>



            </div>
        </div>
    </div>

    @endsection