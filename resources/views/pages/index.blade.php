<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PicknRide</title>

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">

    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
</head>
<body style="font-family: verdana;">

<!-- Include navigation bar -->

   <!-- Navigation bar -->
    @include('includes.navbar')

<!-- Header Carousel -->    
<div class="row shadow-lg">
    <div class="col-12">

        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">

            <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1" class=""></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2" class=""></li>
            </ol>

            <div class="carousel-inner slider">
                
            <div class="carousel-item active">
                <img class="d-block w-100" src="{{$baseURL}}img/slide1.jpg" alt="First slide">
                    <div class="slider-box landing-text col-10">
                            <h1 class="font-weight-bolder carousel-text"> Pick and drop services at your fingertips. </h1>
                            <h3 class="carousel-text"> Just enter your preferred time and route details to look for
                                a desired ride around your area.
                            </h3>
                            <a href="{{ url('searchRide') }}">
                            <button type="button" class="btn btn-dark btn-lg">
                                Search for a Ride
                            </button>
                            </a>
                    </div>
            </div>

            <div class="carousel-item">
                <img class="d-block w-100" src="{{$baseURL}}img/slide2.jpg" alt="Second slide">
                    <div class="slider-box col-10">
                            <div class="row text-white text-center">
                                <div class="col-md-8">
                                    <h1 class="font-weight-bolder carousel-text">Register as a Service Provider</h1>
                                </div>
                                <div class="col-md-4">
                                    <div class="input-group ml-6 ">
                                    <a href="{{ route('register') }}">
                                        <button type="button" class="btn btn-dark btn-lg">
                                            Register @PicknRide
                                        </button>
                                    </a>
                                    </div>
                                </div>
                            </div>
                    </div>
            </div>


            <div class="carousel-item">
                <img class="d-block w-100" src="{{$baseURL}}img/slide3.jpg" alt="Third slide">
                
                <div class="slider-box col-12">
                    <div class="row text-white">
                        <h1 class=" display-4 font-weight-bolder text-center carousel-text" 
                        style="margin: 0px 0px 300px 0px;"> Customer services is our prime goal. </h1>
                    </div>
                </div>
            </div>

            <!-- Carousel Control -->
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
            </a>
            
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
            </a>
            
        </div>

        </div>
    </div>
</div>
<!-- End of Carousel -->



<!-- Jumbotron -->

<div class="container-fluid mt-5 mb-5">
    <div class="row jumbotron">
        <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9 col-xl-10">
            <h4 class="two-sec-text">
                We provide a platform between the passengers and the "Pick and drop"
                service providers. Our goal is to help you both, to provide an efficient
                and convenient method in the process of booking a suitable ride.
            </h4>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3 col-xl-2 mt-4">
            <a href="{{ url('about') }}"> 
                <button type="button" class="btn btn-outline-dark "> 
                About Us </button> 
            </a>
        </div>
    </div>
</div>


<br>
<!-- Two column section Search for a ride -->
<div class="container-fluid my-5 py-5">
    <div class="row">
        <div class="col-md-6 col-sm-12 mt-5">
            <h3 class="sec2-txt"> We'll provide you a suitable, regular use pick and drop service. We
                have access to various PicknDrop service providers.
                <div class="space"></div>
                    <a href="{{ url('searchRide') }}"> <button type="button" class="btn btn-dark mt-5 btn-md"> 
                        Search for a Ride
                        </button>
                    </a>
            </h3>
        </div> 
        <div class="col-md-6 col-sm-12">
            <img src="{{$baseURL}}img/search-ride.png" class="img-fluid " alt="">
        </div>
    </div>
</div>

<!-- Two column section Register as a driver -->
<hr>
<div class="container-fluid my-5 py-5">
        <div class="row">
            
            <div class="col-md-6 col-sm-12">
                <img src="{{$baseURL}}img/register.png" class="img-fluid w-75" alt="">
            </div>
            <div class="col-md-6 col-sm-12">
                <h3 class="sec2-txt"> Get yourself rgistered at PicknRide and Get
                    connected to the various customers who are looking forward to your best
                    services. 
                    <div class="space"></div>
                <a href="{{ url('register') }}"> <button type="button" class="btn btn-dark mt-5 btn-md"> Register as service provider
                    </button></a>
                </h3>
            </div>            
        </div>
</div>

<!-- Two column section with image -->
<hr>
<div class="container-fluid  my-5">
        <div class="row">
            <div class="col-md-6 col-sm-12 text-center mt-5">
                <h2>Gotcha.,!</h2>
                <h3 class="sec2-txt"> If you haven't find yet any service within your area,
                    register here so that we can notify you when any service provider 
                    got registered around your area.
                    <div class="space"></div>
                        <!-- <a href=" {{ url('register') }} "> <button type="button" class="btn btn-dark mt-5 btn-md"> 
                            Register as user
                            </button>
                        </a> -->
                </h3>
            </div> 
            <div class="col-md-6 col-sm-12">
                <img src="{{$baseURL}}img/ride.png" class="img-fluid" alt="">
            </div>
        </div>
    </div>
    <hr>


<div class="container-fluid my-5 py-5">
    <div class="row padding">
        <div class="col-md-6 col-sm-12 text-center mt-5">
            <h2> About Us </h2>
            <h4 class="two-sec-text"> We provide a platform between the passengers and the "Pick and drop" service providers. Our goal is to help you both, to provide an efficient and convenient method in the process of booking a suitable ride.
   
            </h4>
            <br>
            <a href="{{ url('/about') }}"> <button type="button" class="btn btn-dark btn-md"> More about us</button></a>
        </div>
        <div class="col-md-6 col-sm-12">
                <img src="{{$baseURL}}img/AboutUs.png" class="img-fluid" alt="">
            </div>
        </div>
</div>



<!-- fixed bg image -->
<figure class="my">
    <div id="fixed" class="shadow-lg">
        <h1 class="font-weight-bold text-center text-white display-5 " style="padding: 160px 0px 0px 0px;">
            The goal is to provide people with a clean and affordable service. 
        </h1>
    </div>
</figure>

<!-- People opinion section -->
<div class="container-fluid shadow pb-5">
    <div class="row welcome text-center mb-3">
        <div class="col-12 mt-5 ">
            <h1 class="display-5"> People Opinions about Pick n Ride Finder </h1>
        </div>
        <hr>

        <div class="col-2 my-5">
            <i class="fa fa-quote-left fa-2x"></i>
        </div>
    
        <div class="col-10 col-xs-12 my-5">
            <h4 class="two-sec-text">
            Very much satisfied with PicknRide service. It saves my time and
            provides good convenience 
            <br><br>
            
            - Malik Arbaz Khan
            </h4>
        </div>
        <hr class="light">
        
        <div class="col-10 col-xs-12 my-5">
            <h4 class="two-sec-text ">
                Pick n Ride service is unique they are verified car service center
                and it has a lot of potential in future. All the best. 
            <br><br>

            - CSP. Usama C.
            </h4>
        </div>
        <div class="col-2  my-5">
            <i class="fa fa-quote-right fa-2x"></i>
        </div>
    </div>
</div>


<!-- Meet the team -->

<div class="container-fluid my-5 pt-5">
    <div class="row welcome text-center">
        <div class="col-12">
            <h1 class="">Meet the team</h1>
        </div>
        <hr>
    </div>
</div>
<!-- Cards -->

<div class="container-fluid padding">
    <div class="row ">
        <div class="col-md-4">
            <div class="card">
                <div class="">
                    <img src="{{$baseURL}}img/malik.jpg" alt="" class="card-img-top set-pic img-fluid">
                </div>
                <div class="card-body">
                    <h4 class="card-title">
                        Malik Ateeq
                    </h4>
                    <p class="card-text">
                        Our Frontend developer
                    </p>
                    <a href="https://www.demoaspire.com/malikateeq" target="_blank" class="btn btn-outline-dark btn-sm">
                    See profile</a>
                </div>
            </div>
        </div>

        
        <div class="col-md-4">
            <div class="card">
                    <img src="{{$baseURL}}img/khalid.png" alt="" class="card-img-top set-pic img-fluid">
                    <div class="card-body">
                    <h4 class="card-title">
                            Khalid Raza
                    </h4>
                    <p class="card-text">
                            Our Frontend developer
                    </p>
                    <a href="https://www.facebook.com/" class="btn btn-outline-dark btn-sm">
                    See profile</a>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card">
                <img src="{{$baseURL}}img/saad.jpg" alt="" class="card-img-top set-pic img-fluid">
                    <div class="card-body">
                        <h4 class="card-title">
                                Saad Ullah
                        </h4>
                        <p class="card-text">
                                Our Frontend developer
                        </p>
                        <a href="https://www.facebook.com/" class="btn btn-outline-dark btn-sm">
                        See profile</a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Connect with us -->

<div class="container-fluid mt-5 mb-5">
    <div class="row text-center padding">
        <div class="col-12">
            <h2>Connect</h2>
        </div>
        <div class="col-12 social">
            <a href="#"><img src="{{$baseURL}}img/fb.png" alt=""></a>
            <a href="#"><img src="{{$baseURL}}img/tw.png" alt=""></a>
            <a href="#"><img src="{{$baseURL}}img/g.png" alt=""></a>
            <a href="#"><img src="{{$baseURL}}img/insta.png" alt=""></a>
            <a href="#"><img src="{{$baseURL}}img/yt.png" alt=""></a>
        </div>
    </div>
</div>


@include('includes.footer')

<!-- Scripts -->

</body>
</html>