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

<table class="table">
<tr>
    <th style="width: 50px;text-align:center;">ID</th>
    <th style="width: 50px;text-align:center;">Name</th>
    <th style="width: 200px;text-align:center;">User Id</th>
    <th style="width: 200px;text-align:center;">User Name</th>
    <th style="width: 50px;text-align:center;">Unit/mnth</th>
    <th style="width: 50px;text-align:center;">Price</th>
    <th style="width: 50px;text-align:center;">Status</th>
    <th colspan="3">Actions</th>
</tr>
@foreach ($meters as $post )
    <tr>
        <td style="width: 50px;text-align:center;">{{$post->id}}</td>
        <td style="width: 50px;text-align:center;">{{$post->name}}</td>
        <td style="width: 50px;text-align:center;">{{$post->user_id}} @if($post['user_id']==NULL)Not assigned to any user @endif </td>
        <td style="width: 50px;text-align:center;">{{$post->user_name}} @if($post['user_id']==NULL)Not assigned to any user @endif</td>
        <td style="width: 50px;text-align:center;">{{$post->unit}}</td>
        <td style="width: 50px;text-align:center;">{{$post->price}}</td>
        @if($post['status']=="available")
        <td style="width: 50px;text-align:center;color:green">{{$post->status}}</td>
        @elseif($post['status']="processing")
        <td style="width: 50px;text-align:center; color:red">{{$post->status}}</td>
        @endif
        <td style="width: 50px;text-align:center;"><form action="/admin/meter/{{$post->id}}/edit" method="GET"> <input class="btn btn-success" type="submit" value="Update"></form></td>
        <form method="POST" action="/admin/meter/{{$post->id}}">
        @csrf
        @method('delete')
        <td><input class="btn btn-danger" type="submit" value="Delete"></td>
        </form>
      


    </tr>
@endforeach

</table>
<form method="GET" action="/admin/meter/create">
   
    <input class="btn btn-primary" type="submit" value="Add Meter">
    </form>

            </div>
        </div>
    </div>
</div>
@endsection