@extends('admin.dashboard')
@section('content')
    

@if (session('status'))
<div>
    <b-alert show dismissible>
      SUCCESS! {{session('status')}} <b>&rArr;</b>
    </b-alert>
  </div>
@endif

<table class="table">
<tr>
    <th style="width: 40px;">id</th>
    <th style="width: 40px;">Name</th>
    <th style="width: 40px;">Email</th>
    <th style="width: 40px;">Role</th>
    <th colspan="3">Actions</th>
</tr>
@foreach ($data as $post )
    <tr>
        <td style="width: 40px;">{{$post->id}}</td>
        <td style="width: 40px;">{{$post->name}}</td>
       
        <td style="width: 40px;">{{$post->email  }}</td>
        <td style="width: 40px;">{{$post->role  }}</td>

        <td style="width: 40px;"><a href="/user/{{$post->id}}/edit"><button class="btn btn-info">Edit</button></a></td>
        <form method="POST" action="/user/{{$post->id}}">
        @csrf
        @method('delete')
        <td><input class="btn btn-warning" type="submit" value="Delete"></td>
        </form>
       


    </tr>
@endforeach

</table>
<a href="/user/create" class="btn btn-primary" >Create User</a>
@endsection