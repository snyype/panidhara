@extends('admin.dashboard')
@section('content')
    
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="col-md-8">
                @livewire('meter-search-bar')
                <br>
            </div>
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
    <th style="width: 50px;text-align:center;">Meter Number</th>
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
        @if($post['user_id']==NULL)
        <td style="width: 50px;text-align:center;">{{$post->name}}</td>
        @else
        <td style="width: 50px;text-align:center;color:red">{{$post->name}}</td>
        @endif
        @if($post['user_id']==NULL)
        <td style="width: 50px;text-align:center;">{{$post->meter_number}}</td>
        @else
        <td style="width: 50px;text-align:center;color:red">{{$post->meter_number}}</td>
        @endif
        <td style="width: 50px;text-align:center;"> @if($post['user_id']==NULL)Id not assigned @else <span style="color:red">{{$post->user_id}}</span> @endif </td>
        <td style="width: 50px;text-align:center;"> @if($post['user_name']==NULL)Name Not assigned @else <span style="color:red">{{$post->user_name}}</span> @endif</td>
        <td style="width: 50px;text-align:center;">{{$post->unit}}</td>
        @if($post['due_amount']==NULL)
        <td style="width: 50px;text-align:center;">{{$post->price}}</td>
        @else
        <td style="width: 150px;text-align:center;color:red">PAID</td>
        @endif
        @if($post['status']=="available")
        <td style="width: 50px;text-align:center;color:green">{{$post->status}}</td>
        @elseif($post['status']="Booked")
        <td style="width: 50px;text-align:center; color:red">{{$post->status}}</td>
        @endif
        <td style="width: 50px;text-align:center;"><form action="/admin/meter/{{$post->id}}/edit" method="GET"> <input class="btn btn-success" type="submit" value="Update"></form></td>
        @if($post['status']=="Booked")
        <td><input class="btn btn-danger" type="submit" value="Delete" disabled title="Booked meter cannot be deleted"></td>
        @elseif($post['status']=="available")
        <form method="POST" action="/admin/meter/{{$post->id}}">
            @csrf
            @method('delete')
            <td><input class="btn btn-danger" type="submit" value="Delete"></td>
            </form>
       
        @endif
    </tr>

@endforeach
</table>







</table>
<form method="GET" action="/admin/meter/create">
   
    <input class="btn btn-primary" type="submit" value="Add Meter">
    </form>

            </div>
        </div>
    </div>
</div>

@endsection