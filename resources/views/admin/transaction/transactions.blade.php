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
                <div class="table-responsive">
@if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif

<table class="table text-nowrap">
    <thead>
<tr>
    <th style="width: 50px;text-align:center;">ID</th>
    <th style="width: 50px;text-align:center;">Transaction Id</th>
    <th style="width: 50px;text-align:center;">Transaction State</th>
    <th style="width: 200px;text-align:center;">Amount</th>
    <th style="width: 200px;text-align:center;">Fee Amount</th>
    <th style="width: 50px;text-align:center;">Meter Id</th>
    <th style="width: 200px;text-align:center;">Meter Name</th>
    <th style="width: 200px;text-align:center;">Payment Type</th>
    <th style="width: 200px;text-align:center;">Users Name</th>
    <th style="width: 200px;text-align:center;">Users Phone</th>
    <th style="width: 200px;text-align:center;">Remarks</th>
    <th style="width: 200px;text-align:center;">Refunded</th>
    <th style="width: 200px;text-align:center;">Cashback</th>
    <th style="width: 50px;text-align:center;">Token</th>
    <th style="width: 50px;text-align:center;">Transcation Time</th>
    <th colspan="3">Actions</th>
</tr>
</thead>
<tbody>
@foreach ($data as $post )
    <tr>
        <td style="width: 70px;text-align:center;">{{$post->id}}</td>
        <td style="width: 70px;text-align:center;">{{$post->transaction_id}}</td>
        <td style="width: 70px;text-align:center;">{{$post->transaction_state}}</td>
        <td style="width: 70px;text-align:center;">Rs.{{$post->amount}}</td>
        <td style="width: 70px;text-align:center;">Rs.{{$post->fee_amount}}</td>
        <td style="width: 70px;text-align:center;">{{$post->meter_id}}</td>
        <td style="width: 70px;text-align:center;">{{$post->meter_name}}</td>
        <td style="width: 70px;text-align:center;">{{$post->payment_type}}</td>
        <td style="width: 70px;text-align:center;">{{$post->user_name}}</td>
        <td style="width: 70px;text-align:center;">{{$post->user_phone}}</td>
        <td style="width: 70px;text-align:center;">{{$post->remarks}}</td>
        <td style="width: 70px;text-align:center;">{{$post->refunded}}</td>
        <td style="width: 70px;text-align:center;">{{$post->cashback}}</td>
        <td style="width: 70px;text-align:center;">{{$post->token}}</td>
        <td style="width: 70px;text-align:center;">{{$post->created_at}}</td>
        <td style="width: 70px;text-align:center;"><form action="/admin/transaction/view/invoice-details/{{$post->id}}" method="GET"> <input class="btn btn-success" type="submit" value="View Invoice"></form></td>
    </tr>
@endforeach
</tbody>




            </div>
        </div>
    </table>
   
        </div>
      
    </div>
    <form method="GET" action="/admin/transaction/export-transaction">
        <td><input class="btn btn-danger" type="submit" value="Export Excelsheet"></td>
        </form><br>
</div>
@endsection