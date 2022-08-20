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
  
    <form action="/admin/meter" method="POST" enctype='multipart/form-data'>
        <div class="form-group">
            @csrf
            @error('title')
            <div class="alert alert-danger">Please enter Name</div>
            @enderror
        
          <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Name" name="user_id" hidden>
          
        </div>
        <div class="form-group">
        
          <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Enter Description Here" name="user_name" hidden>
        </div>
        <div class="form-group">
        
            <input type="number" class="form-control" id="exampleInputPassword1" placeholder="Enter Tanker Price" name="unit" hidden>
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Click Add Meter Below To Add</label>
            <input type="number" class="form-control" id="exampleInputPassword1" placeholder="Enter Tanker Capacity" name="status" hidden>
          </div><br>

        <button type="submit" class="btn btn-primary">Add Meter</button>
      </form>
      <form action="/admin/meter">
      <div style="margin-top:10px"><button type="submit" style="width: 100px" class="btn btn-danger">Cancel</button></a></div>
    </div></form>
      
    </div>
    </div>
    </div>
  </div>
</div>
    @endsection