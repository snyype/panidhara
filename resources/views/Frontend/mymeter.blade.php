
<?php
use Carbon\Carbon;
$user = auth()->user();
?>
<!DOCTYPE html>
<html>

<head>
  <!-- Basic -->
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <!-- Mobile Metas -->
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <!-- Site Metas -->
  <meta name="keywords" content="" />
  <meta name="description" content="" />
  <meta name="author" content="" />

  <title>Panidhara | My Meter</title>

  <!-- slider stylesheet -->
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.1.3/assets/owl.carousel.min.css" />

  <!-- bootstrap core css -->
  <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />

  <!-- fonts style -->
  <link href="https://fonts.googleapis.com/css?family=Baloo+Chettan|Dosis:400,600,700|Poppins:400,600,700&display=swap" rel="stylesheet" />
  <!-- Custom styles for this template -->
  <link href="css/style.css" rel="stylesheet" />
  <!-- responsive style -->
  <link href="css/responsive.css" rel="stylesheet" />

  <script src="https://khalti.s3.ap-south-1.amazonaws.com/KPG/dist/2020.12.17.0.0.0/khalti-checkout.iffe.js"></script>
</head>

<body>
  <div style="max-width:100%">
  
    <section id="top" style="max-width: 100%" class=" slider_section position-relative">
      <div id="carouselExampleControls" class="carousel slide " data-ride="carousel">
        <div class="carousel-inner">
            
          <div  class="carousel-item active">
            <div style="height:270px;width:100%" class="img-box">
              <img style="width: 100%;height:100%" src="{{asset('images/carousel/bannerr.jpg')}}" alt="">
            </div>
          </div>
         
          @foreach ($carousel as $item)
          <div class="carousel-item">
          
            <div class="carousel-caption d-none d-md-block slider-text">
            <h3 class="display-4">{{$item->name}}</h3>
                <p class="lead">{{$item->desc}}</p>
                </div>
            <div style="height:270px;width:100%" class="img-box">
            <img style="max-width: 100%;height:100%" src="{{asset('images/carousel/'.$item["gallery"])}}" alt="">
            </div>
            </div>
          </div>
          @endforeach
       
        </div>
       
        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
          <span class="sr-only">Next</span>
        </a>
        
      </div> 
    </section>

  </div>

  <!-- nav section -->

  <section class="nav_section">
    <div class="container">
      <div class="custom_nav2">
        <nav class="navbar navbar-expand custom_nav-container ">
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>

          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <div class="d-flex  flex-column flex-lg-row align-items-center">
              <ul class="navbar-nav  ">
                <li class="nav-item active">
                  <a class="nav-link" href="/">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#aboutus">About Us</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#tankers">Our Service</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="/testimonial">Testimonial</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#contactus">Contact Us</a>
                </li>
                @php
                use App\Models\Notification;
                if(auth()->check()){
                  $new_notification = Notification::where('user_id', auth()->user()->id)->where('is_opened', false)->get();
              $count_notification = Notification::where('user_id', auth()->user()->id)->where('is_opened', false)->count();
                }
              else{
                $new_notification = [];
                $count_notification = 0;
              }
                    
                @endphp

                <li class="nav-item">
                  <a class="nav-link" href="/notifications">Notifications <span style="border-radius:10px; background:red; width:60px; height:10px; padding-right:8px;padding-left:8px;padding-top:1px;">{{$count_notification}}</span></a>
                </li>
                @if(Auth::user())
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" data-target="#navItemGame"  id="navbarDropdown" role="button" data-toggle="dropdown" v-pre ><?php
                    print($user->name);?> @if($user['verified']=='2')<img style='width: 25px;height:25px' title="Verified User" src='{{asset("/images/badges/admin.png")}}'/>@endif
                  </a>
                
                <div id="#navItemGame" class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a id="#navItemGame" class="dropdown-item" href="/myrequests">My Requests</a>
                    <a id="#navItemGame" class="dropdown-item" href="/mymeter">My Meter Info</a>
                    <a id="#navItemGame" class="dropdown-item" href="/maintainance">Maintainance</a>
                    <a id="#navItemGame" class="dropdown-item" href="/user">Profile</a>
                    <a id="#navItemGame" class="dropdown-item" href="/logout">Logout</a>
                  </div>
                </li>
                  @else
                  <li class="nav-item">
                    <a class="nav-link" href="/login">
                      <i class="fa fa-user" style="color:green">
                       
                      </i>
                      Login
                    </a>
                  </li>
            @endif
            @if ($user==NULL)
            <span></span>
            @else
      @if($user['role']=='2')
            <li class="nav-item">
              <a class="nav-link" href="/admin">
                <i class="fa fa-lock" style="color:red">
                  
                </i>
                Admin
              </a>
            </li>
            @else
                <span></span>
            
            @endif
            @endif
              </ul>
              <form class="form-inline my-2 my-lg-0 ml-0 ml-lg-4 mb-3 mb-lg-0">
                <button class="btn  my-2 my-sm-0 nav_search-btn" type="submit"></button>
              </form>
            </div>
          </div>
        </nav>
      </div>
    </div>
  </section>

  <!-- end nav section -->

  <!-- shop s@ection -->
 
      
 


  <section class="shop_section layout_padding">
    <div class="container">
      <div class="box">
        <div class="detail-box">
          <h2>
          MY Meter Status
          </h2>
          <p>
          </p>
        </div>
        <div class="container-fluid">
            <div class="row">
  
        <div style="margin-bottom: 30px" class="col-md-3">
        <div class="img-box">
        
     
        <!-- </div>
        <div class="btn-box">
          <a onclick="alert('Sorry this tanker is being delivered')">
            ❌ Booked
          </a>
        </div>
        </div> -->

            </div>
        </div>
      </div>
    </div>
  </section>

  
  <!-- end shop section -->

  <!-- Table section -->
 <div class="container">
 <table class="table table-hover">
  <thead>
   
    <tr>
      <th scope="col">#</th>
      <th scope="col">Meter Number</th>
      <th scope="col">Meter Holder Name</th>
      <th scope="col">Meter Unit</th>
      <th scope="col">Meter Status</th>
      <th scope="col">Meter Updated</th>
      <th scope="col">Due Amount</th>
      <th scope="col">Actions</th>
    </tr>
  </thead>
  <tbody>
   
  @if($count !== 0)

    <tr>
      <th scope="row">1</th>
      <td>{{$mymeter->meter_number}}</td>
      <td>{{$mymeter->user_name}}</td>
      <td>{{$mymeter->unit}}</td>
      @if($mymeter['status']=="Booked")
      <td style="color:red">{{$mymeter->status}} | Owned</td>
      @else
      <td style="color:red">{{$mymeter->status}} | Owned</td>
      @endif
      <td>{{ Carbon::create($mymeter->updated_at)->diffForHumans() }}</td>
      <td>Rs. {{$mymeter->due_amount}}</td>
      @if($mymeter['due_amount']==0)
      <td><button onclick="alert('You have Rs. {{$mymeter->due_amount}} due amount to pay ')" class="btn btn-info">PAID</button></td>
      @else
      <td><button id="payment-button" class="btn btn-success">Pay Dues</button></td>
      @endif
    </tr>
    
  @else

  <tr>
    <th scope="row">N/A</th>
    <td>N/A</td>
    <td>N/A</td>
    <td>N/A</td>
    <td>N/A</td>
    <td>N/A</td>
    <td>N/A</td>
  </tr>
@endif
  </tbody>

</table>


@if($count == 0)


<section class="shop_section layout_padding">
    <div class="container">
      <div class="box">
        <div class="detail-box">
          <h2 style="color:red">
  YOU DONT OWN ANY METERS YET
          </h2>
          <p>
          </p>
        </div>
        <div class="container-fluid">
            <div class="row">
  
       

            </div>
        </div>
      </div>
    </div>
  </section>
  @else
  <section class="shop_section layout_padding">
    <div class="container">
      <div class="box">
        <div class="detail-box">
            @if($count != 0)
          <p>
            Your Meter Unit For This Month Is : {{$mymeter->unit}} <br>
            Your Due Amount : <span style="color:red">Rs. {{$mymeter->due_amount}}</span><br><br><br>
            Note: Per unit is charged Rs.15
          </p>
          @else
          <p>
          
          </p>
          @endif
        </div>
        <div class="container-fluid">
            <div class="row">
  
       

            </div>
        </div>
      </div>
    </div>
  </section>

@endif

<br><br><br>
 </div>
  
                                                      
  

  <!-- info section -->

  <section class="info_section layout_padding">
    <div class="container">
      <div class="info_logo">
        <h2>
         PANIDHARA
        </h2>
      </div>
      <div class="info_contact">
        <div class="row">
          <div class="col-md-4">
            <a href="">
              <img src="images/location.png" alt="">
              <span>
                Kapan, Kathmandu, Nepal
              </span>
            </a>
          </div>
          <div class="col-md-4">
            <a href="">
              <img src="images/call.png" alt="">
              <span>
                Call : +012334567890
              </span>
            </a>
          </div>
          <div class="col-md-4">
            <a href="mailto:panidhara@myktm.ml">
              <img src="images/mail.png" alt="">
              <span>
               panidhara@myktm.ml
              </span>
            </a>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-8 col-lg-9">
          <div class="info_form">
            <form action="">
              <input type="text" placeholder="Enter your email">
              <button>
                subscribe
              </button>
            </form>
          </div>
        </div>
        <div class="col-md-4 col-lg-3">
          <div class="info_social">
            <div>
              <a href="">
                <img src="images/facebook-logo-button.png" alt="">
              </a>
            </div>
            <div>
              <a href="">
                <img src="images/twitter-logo-button.png" alt="">
              </a>
            </div>
            <div>
              <a href="">
                <img src="images/linkedin.png" alt="">
              </a>
            </div>
            <div>
              <a href="">
                <img src="images/instagram.png" alt="">
              </a>
            </div>
          </div>
        </div>
      </div>

    </div>
  </section>

  <!-- end info section -->


  <!-- footer section -->
  <section class="container-fluid footer_section ">
    <p>
      &copy; <span id="displayYear"></span> All Rights Reserved. Design by
      <a href="https://www.snype.tk/">Aashish</a><a style="float: right" href="#top"><button style="border: 0px;background:none;">Go To Top</button></a>
    </p>
  </section>
  <!-- footer section -->

  <script type="text/javascript" src="js/uijs/jquery-3.4.1.min.js"></script>
  <script type="text/javascript" src="js/uijs/bootstrap.js"></script>
  <script type="text/javascript" src="js/uijs/custom.js"></script>


  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
         <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
         <script>
          var config = {
              // replace the publicKey with yours
              "publicKey": "{{ config('app.khalti_public_key') }}",
              "productIdentity": "{{$mymeter->id}}",
              "productName": "{{$mymeter->name}}",
              "productUrl": "http://127.0.0.1:8000/request-now/{{$mymeter->id}}",
              "paymentPreference": [
                  "KHALTI",
                  "EBANKING",
                  "MOBILE_BANKING",
                  "CONNECT_IPS",
                  "SCT",
                  ],
              "eventHandler": {
              
                  onSuccess (payload) {
                      // hit merchant api for initiating verfication
                      $.ajax({
                          type : 'POST',
                          url : "{{ route('khalti.verifyPaymentForDue') }}",
                          data: {
                              token : payload.token,
                              amount : payload.amount,
                              "_token" : "{{ csrf_token() }}"
                          },
                          success: function(res){
                            console.log('payment successful');
                            console.log(res);
                            alert('Payment successful');
                            window.location.href = "/mymeter";
                           },
                           
                             
                          
                      });
                      console.log(payload);
                  },
                  onError (error) {
                      console.log(error);
                      alert('Payment error');
                  },
                  onClose () {
                      console.log('widget is closing');
                  }
              }
          };
  
          var checkout = new KhaltiCheckout(config);
          var btn = document.getElementById("payment-button");
          btn.onclick = function () {
              // minimum transaction amount must be 10, i.e 1000 in paisa.
              checkout.show({amount: 1000});
          }
      </script>
</body>

</html>
