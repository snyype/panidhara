@extends('admin.dashboard')
@section('content')
    
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="col-md-8">
                <div class="col-md-4">
                    <form action="/admin/search-transaction" method="POST">
                        @csrf
                    <input type="text" placeholder="search transaction id" name="query" class="form-control mt-0">
                    <button class="col-md-4 form-control mt-0">Search</button>
                   
                    </form>
                </div><br>
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
    <th style="width: 50px;text-align:center;">Transaction Id</th>
    <th style="width: 50px;text-align:center;">Meter Id</th>
    <th style="width: 200px;text-align:center;">Meter Name</th>
    <th style="width: 200px;text-align:center;">Amount</th>
    <th style="width: 50px;text-align:center;">Token</th>

</tr>
@if(count($data) == 0)
<tr>
    <td style="width: 50px;text-align:center;">NO MATCH</td>
    <td style="width: 50px;text-align:center;">NO MATCH</td>
    <td style="width: 50px;text-align:center;">NO MATCH</td>
    <td style="width: 50px;text-align:center;">NO MATCH</td>
    <td style="width: 50px;text-align:center;">NO MATCH</td>
    <td style="width: 50px;text-align:center;">NO MATCH</td>
  
</tr>
@else
@foreach ($data as $post )



    <tr>
        <td style="width: 50px;text-align:center;">{{$post->id}}</td>
        <td style="width: 50px;text-align:center;">{{$post->transaction_id}}</td>
        <td style="width: 50px;text-align:center;">{{$post->meter_id}}</td>
        <td style="width: 50px;text-align:center;">{{$post->meter_name}}</td>
        <td style="width: 50px;text-align:center;">Rs.{{$post->amount}}</td>
        <td style="width: 50px;text-align:center;">{{$post->token}}</td>
      
    </tr>
   
@endforeach
@endif






</table>
<form method="GET" action="/admin/transaction">
   
    <input class="btn btn-primary" type="submit" value="Go Back">
    </form>


            </div>
        </div>
    </div>
</div>
@endsection