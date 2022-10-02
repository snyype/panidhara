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
  
    <form action="/admin/meter/{{$data->id}}" method="POST" enctype='multipart/form-data'>
        
           
            @csrf
         
   
        <div class="form-group">
          <label for="exampleInputPassword1">User Id</label>
          <input type="text" class="form-control" id="exampleInputPassword1"  name="user_id" value="{{$data->user_id}}">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">User Name</label>
            <input type="text" class="form-control" id="exampleInputPassword1"  name="user_name" value="{{$data->user_name}}">
          </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Name</label>
            <input type="text" class="form-control" id="exampleInputPassword1"  name="name" value="{{$data->name}}">
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Price</label>
            <input type="number" class="form-control" id="exampleInputPassword1"  name="price" value="{{$data->price}}">
          </div><br>
          <div class="form-group">
            <select class="form-control" id="exampleInputPassword1" name="status" id="" required>
              <option value="{{$data->status}}">Change Status from {{$data->status}}</option>
              <option value="Booked">Booked</option>
              <option value="available">available</option>
            </select>
          </div><br>
          <div class="form-group">
            <label for="exampleInputPassword1">Unit</label>
            <input type="number" class="form-control" id="exampleInputPassword1"  name="unit" value="{{$data->unit}}">
          </div><br>
        
        <button type="submit" class="btn btn-success">Update Meter</button>
      </form>
      <form action="/admin/meter">
      <div style="margin-top:10px"><button type="submit" style="width: 116px" class="btn btn-danger">Cancel</button></a></div>
    </div></form>
      
    </div>



            </div>
        </div>
    </div>

    @endsection