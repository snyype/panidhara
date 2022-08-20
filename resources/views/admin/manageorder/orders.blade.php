
@extends('admin.dashboard')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="white-box">
                <div class="container">


    <div class="custom-product">
        <div class="col-sm-12">
         <div class="trending-wrapper">
             <h4>Active Orders</h4><br>
             @foreach ($orders as $item)
             <div class="row searched-item cart-list-divider">
             <div class="col-sm-3">
                
                     <img style="width: 200px; height: 100px" class="trending-image" src="{{asset('/images/orders/order.jpg')}}">
     
              
             </div>
             <div class="col-sm-3">
                 
                <div class="item-desc">
                        <h2>{{$item->tanker_name}}</h2>
                        <h5>User : {{$item->user_name}}</h5>
                        <h5>Capacity : {{$item->capacity}}L</h5>
                        <h5>Price : Rs.{{$item->price}}</h5>
                        <h5>Payment Status : {{$item->payment}} on delivery</h5>
                        <h5>Deleviry Status : {{$item->status}}</h5>
                        <h5>Number : {{$item->number}}</h5>
                        <h5>Address : {{$item->address}}</h5>
                        <h5>Street : {{$item->street}}</h5>
                      
                </div>
                <button class="btn btn-danger"><a style="text-decoration: none;color:black" href="/admin/orders/orderleft/{{$item->id}}"> Order Left</button></a><br><br>
                <button class="btn btn-danger"><a style="text-decoration: none;color:black" href="/admin/orders/orderdelivered/{{$item->id}}">Order delivered</button></a><br><br>
                <button class="btn btn-danger"><a style="text-decoration: none;color:black" href="/admin/orders/closeorder/{{$item->tanker_id}}">Close Order</button></a>
             </div>
             </div>
             
             <div style="margin-bottom: 40px" class="col-sm-3">
                 
                <div class="item-desc">
               
               
           
                @if($item["status"]=="pending")
                <form action="/admin/orders/ordercanceled/{{$item->id}}" method="POST">
                        @csrf
                        @method('delete')
                <button class="btn btn-danger">Cancel Order</button>
        </form>@endif
            </div>
                     
             </div>
            
       </div>
      @endforeach
     </div>
       
     </div><br><br>


</div>
            </div>
        </div>
    </div>
</div>


@endsection