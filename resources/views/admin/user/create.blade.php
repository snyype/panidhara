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
@if (session('error'))
<div class="alert alert-danger">
    {{ session('error') }}
</div>
@endif
<div class="container">
      <form action="/admin/userstable" method="POST">
        <div class="form-group">
            @csrf
            
          <label for="exampleInputEmail1">Name</label>
          <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Name" name="name" required>
          
        </div>
        <div class="form-group">
          
          <label >Email</label>
          <input type="email" class="form-control"  placeholder="Enter Email" name="email" required>
        </div>
        <div class="form-group">
            <label>Password</label>
            <input type="password" class="form-control"  placeholder="Enter Password" name="password">
          </div><br>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="role" id="flexRadioDefault1" value="2">
            <label class="form-check-label" for="flexRadioDefault1">
              Admin 
            </label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="role" id="flexRadioDefault2" value="1" checked>
            <label class="form-check-label" for="flexRadioDefault2">
              User
            </label>
          </div><br>

          <div class="form-check">
            <input class="form-check-input" type="radio" name="verified" id="flexRadioDefault1" value="2">
            <label class="form-check-label" for="flexRadioDefault1">
              Verified 
            </label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="verified" id="flexRadioDefault2" value="1" checked>
            <label class="form-check-label" for="flexRadioDefault2">
              Not Verified
            </label>
          </div><br>

          
        <button type="submit" class="btn btn-primary">Create User</button>
      </form>
      <div style="margin-top:10px"><a href="/admin/userstable"><button style="width: 100px" class="btn btn-danger">Cancel</button></a></div>
    </div>
          </div>
        </div>
      </div>
    </div>


@endsection