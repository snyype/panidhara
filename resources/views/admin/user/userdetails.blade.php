@extends('admin.dashboard')
@section('content')
    
<body>
  <head>
    <style>

.gradient-custom-2 {
/* fallback for old browsers */
background: #fbc2eb;

/* Chrome 10-25, Safari 5.1-6 */
background: -webkit-linear-gradient(to right, rgba(251, 194, 235, 1), rgba(166, 193, 238, 1));

/* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
background: linear-gradient(to right, rgba(251, 194, 235, 1), rgba(166, 193, 238, 1))
}

    </style>
</head>  


@if (session('status'))
<div>
    <b-alert show dismissible>
      SUCCESS! {{session('status')}} <b>&rArr;</b>
    </b-alert>
  </div>
@endif

<section class="h-100 gradient-custom-2">
    <div class="container py-5 h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col col-lg-9 col-xl-7">
            <a class="btn btn-info" href="/admin/userstable">← Go Back</a>
          <div class="card">
          
            <div class="rounded-top text-white d-flex flex-row" style="background-color: #000; height:200px;">
                <a href="{{$user['gallery2'] ? asset("/images/users/".$user["gallery"]) :asset("/images/users/profile.jpg")}}" onclick="window.open(this.href, '_blank', 'left=40,top=20,width=700,height=700,toolbar=1,resizable=0'); return false;">
              <div class="ms-4 mt-5 d-flex flex-column" style="width: 150px;">
               
                <img src="{{$user->gallery ? asset("/images/users/".$user["gallery"]) :asset("/images/users/profile.jpg")}}"
                  alt="Generic placeholder image" class="img-fluid img-thumbnail mt-4 mb-2"
                  style="width: 150px; z-index: 1">
                {{-- <button type="button" class="btn btn-outline-dark" data-mdb-ripple-color="dark"
                  style="z-index: 1;">
                  Get Address
                </button> --}}
              </div></a>
              <div class="ms-3" style="margin-top: 130px;">
                <h5>{{$user->name}} @if($user['verified']=="2")<img style='width: 30px;height:30px' title="Verified" src='{{asset("/images/badges/admin.png")}}'/></p> @else @if($user['verified']=="1") <p>not verified</p> @endif @endif</h5>
                <p>{{$user->address}}</p>
              </div>
            </div>
            <div class="p-4 text-black" style="background-color: #f8f9fa;">
              <div class="d-flex justify-content-end text-center py-1">
                <div>
                    @php
                    $num = 0;
                    @endphp
                  <p class="mb-1 h5">@if(!empty($user['gallery']) && !empty($user['gallery2']) && !empty($user['gallery3']) ) {{$num+3}} @else 0  @endif</p>
                  <p class="small text-muted mb-0">Photos</p>
                </div>
                {{-- <div class="px-3">
                  <p class="mb-1 h5">1026</p>
                  <p class="small text-muted mb-0">Followers</p>
                </div> --}}
                {{-- <div>
                  <p class="mb-1 h5">478</p>
                  <p class="small text-muted mb-0">Following</p>
                </div> --}}
              </div>
            </div>
            <div class="card-body p-4 text-black">
              <div class="mb-5">
                <p class="lead fw-normal mb-1">About</p>
                <div class="p-4" style="background-color: #f8f9fa;">
                  <p class="font-italic mb-1">Email : {{$user->email}}</p>
                  <p class="font-italic mb-1">Citizenship No : {{$user->citizenship_number}}</p>
                  <p class="font-italic mb-0">Houser No : {{$user->house_number}}</p>
                  <p class="font-italic mb-0">Number : {{$user->number}}</p>
                </div>
              </div>
              <div class="d-flex justify-content-between align-items-center mb-4">
                <p class="lead fw-normal mb-0">Citizenship Photo</p>
                {{-- <p class="mb-0"><a href="" class="text-muted">Show all</a></p> --}}
              </div>
              <div class="row g-2">
                <div class="col mb-2">
                    <a href="{{$user['gallery2'] ? asset("/images/users/".$user["gallery2"]) :asset("/images/users/ctfront.png")}}" onclick="window.open(this.href, '_blank', 'left=40,top=20,width=700,height=700,toolbar=1,resizable=0'); return false;">
                  <img src="{{asset("/images/users/".$user["gallery2"])}}"
                    alt="image 1" class="w-100 rounded-3"></a>
                </div>
                <div class="col mb-2">
                    <a href="{{$user['gallery2'] ? asset("/images/users/".$user["gallery3"]) :asset("/images/users/ctback.png")}}" onclick="window.open(this.href, '_blank', 'left=40,top=20,width=700,height=700,toolbar=1,resizable=0'); return false;">
                  <img src="{{asset("/images/users/".$user["gallery3"])}}"
                    alt="image 1" class="w-100 rounded-3"></a>
                </div>
              </div>
              {{-- <div class="row g-2">
                <div class="col">
                  <img src="https://mdbcdn.b-cdn.net/img/Photos/Lightbox/Original/img%20(108).webp"
                    alt="image 1" class="w-100 rounded-3">
                </div>
                <div class="col">
                  <img src="https://mdbcdn.b-cdn.net/img/Photos/Lightbox/Original/img%20(114).webp"
                    alt="image 1" class="w-100 rounded-3">
                </div>
              </div> --}}
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <div class="container mt-5">
   
  </div>
 
</body>
@endsection