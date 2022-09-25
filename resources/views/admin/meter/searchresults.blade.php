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
    <th style="width: 50px;text-align:center;">Meter Number</th>
    <th style="width: 200px;text-align:center;">User Id</th>
    <th style="width: 200px;text-align:center;">User Name</th>
    <th style="width: 50px;text-align:center;">Unit/mnth</th>
    <th style="width: 50px;text-align:center;">Price</th>
    <th style="width: 50px;text-align:center;">Status</th>
    <th colspan="3">Actions</th>
</tr>

@foreach ($data as $data)
    

    <tr>
        <td style="width: 50px;text-align:center;">{{$data->id}}</td>
        <td style="width: 50px;text-align:center;">{{$data->name}}</td>
        <td style="width: 50px;text-align:center;">{{$data->meter_number}}</td>
        <td style="width: 50px;text-align:center;"> @if($data['user_id']==NULL)Not assigned to any user @else {{$data->user_id}} @endif </td>
        <td style="width: 50px;text-align:center;"> @if($data['user_id']==NULL)Not assigned to any user @else {{$data->user_name}} @endif</td>
        <td style="width: 50px;text-align:center;">{{$data->unit}}</td>
        <td style="width: 50px;text-align:center;">{{$data->price}}</td>
        @if($data['status']=="available")
        <td style="width: 50px;text-align:center;color:green">{{$data->status}}</td>
        @elseif($data['status']="processing")
        <td style="width: 50px;text-align:center; color:red">{{$data->status}}</td>
        @endif
        <td style="width: 50px;text-align:center;"><form action="/admin/meter/{{$data->id}}/edit" method="GET"> <input class="btn btn-success" type="submit" value="Update"></form></td>
        <form method="POST" action="/admin/meter/{{$data->id}}">
        @csrf
        @method('delete')
        <td><input class="btn btn-danger" type="submit" value="Delete"></td>
        </form>
    </tr>
    @endforeach






</table>


            </div>
        </div>
    </div>
</div>
@endsection