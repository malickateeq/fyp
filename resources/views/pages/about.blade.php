<!-- Include main master page -->
@extends('layouts.master')
@section('content')

<div class="container-fluid text-center" style=" padding: 60px 90px; margin: 30px 0px;">
    <h1> About Us </h1>
    <h5 class="py-3 m-5">
            We provide a platform between the passengers and the "Pick and drop" service providers. Our goal is to help you both, to provide an efficient and convenient method in the process of booking a suitable ride.
    </h5>
    <hr>
</div>

<!-- Connect with us -->

<div class="container-fluid  mt-5">
        <div class="row text-center">
            <div class="col-12">
                <h2>Connect with us online!</h2>
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


<div class="container-fluid  mt-5 shadow-lg" style="padding: 30px 50px;">
    <div class="row">
        <div class="col-sm-8 text-center py-5">
            <h1> Our Story </h2>
            <h5 class="">
                We came up with the solution of PicknRide Finder when we see the exixting
                problems that people are facing during PicknRide finding. We decided to
                take this problem and solve using the modern technologies that people are
                using to solve many problems. 
                <br>
                For us taking this problem and solve in our Final Year Project help us to 
                consult with our university professors and get a complete guide in order to
                complete this task.
                <br>
            </h5>
        </div>
        <div class="col-sm-4 text-center">
            <img src="{{$baseURL}}img/together.png" alt="" class="img-fluid">
        </div>
    </div>
</div>

<h1 class="text-center mt-5"> Our Values </h1>
<div class="container-fluid">
        <div class="row text-center" style="margin: 50px 5px;">
            <div class="col-sm-6">
                <h4> Providing customers with optimal solution according to
                    their requirements. </h4>
            </div>
            <div class="col-sm-6">
                <h4> Time is important for any individual, Our focus is to 
                    save customers time by giving them a unique choice. 
                </h4>
            </div>
        </div>

        <div class="row text-center" style="padding: 30px 5px;">
            <div class="col-sm-6">
                <h4> Customer service is our top priority because it helps
                     our company boost in working hard and delivering quality. </h4>
            </div>
            <div class="col-sm-6">
                <h4> It’s best to do one thing really, really well.
                </h4>
            </div>
        </div>
</div>


@endsection