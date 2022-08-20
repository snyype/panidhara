
<?php

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

  <title>HamroTanker</title>

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
                @if(Auth::user())
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" data-target="#navItemGame"  id="navbarDropdown" role="button" data-toggle="dropdown" v-pre ><?php
                    print($user->name);?> @if($user['verified']=='2')<img style='width: 25px;height:25px' title="Verified User" src='{{asset("/images/badges/admin.png")}}'/>@endif
                  </a>
                
                <div id="#navItemGame" class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a id="#navItemGame" class="dropdown-item" href="/myrequests">My Requests</a>
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
          FILL THE FORM BELOW TO PROCEED FURTHER
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

  <!-- Form section -->
  <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
<div class="content">
<div class="container">
    	<div class="row">
	
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb30 text-center">
                        <!-- <h2>FILL THIS FORM TO REQUEST A NEW CONNECTION</h2><BR> -->
                        </div>
                        </div>
	<div class="row">
	
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb30">
                        <div class="tour-booking-form">
                            <form action="/submit-form" method="POST">
                              @csrf
                                <div class="row">
                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                                        <h4 class="tour-form-title">ALL FIELDS ARE MANDATORY</h4><BR>
                                  
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mt30">
                                        <!-- <h4 class="tour-form-title">Your Details</h4> -->
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                                        <div class="form-group">
                                            <label class="control-label" for="name">Name</label>
                                            <input type="text" name="name" placeholder="First and Last Name" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                                        <div class="form-group">
                                           
                                            <input type="text" name="user_name" value="{{$user->name}}" placeholder="First and Last Name" class="form-control" required hidden>
                                            <input type="text" name="user_id" value="{{$user->id}}" placeholder="First and Last Name" class="form-control" required hidden>
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12">
                                        <div class="form-group">
                                            <label class="control-label" for="phone"> Phone</label>
                                            <input  type="number" name="number" placeholder="+9779XXXXXXXXX" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12">
                                        <div class="form-group">
                                            <label class="control-label" for="citizenship no"> Citizenship No.</label>
                                            <input  type="number" name="citizenship_number" placeholder="XXXXXXXX" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12">
                                        <div class="form-group">
                                            <label class="control-label" for="citizenship no"> House No.</label>
                                            <input  type="number"  name="house_number" placeholder="XXXXXX" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12">
                                        <div class="form-group">
                                            <label class="control-label" for="city">Address</label>
                                            <input  type="text"  name="address" placeholder="Enter Address" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                     
                                    </div>
                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                        <button type="submit" class="btn btn-primary">send Enquiry</button>
                                    </div>
                                </div>
                                </form>
                        </div>
                        
                    </div>
	</div>
		<div class="row">
             </div>
</div><br><br><br><br>
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

</body>

</html>
