
<!-- Navigation bar -->

  <nav class="navbar navbar-expand-md navbar-dark custom-nav fixed-top">
  <a class="top-logo" href="{{ url('/') }}">
    <img src="img/white-logo.png" alt="logo">
    <p>PicknRide</p>
  </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="collapsibleNavbar">
      <ul class="navbar-nav ml-auto">

        <li class="nav-item">
          <a class="custom-nav-link" href="{{ url('searchRide') }}">Search Ride</a>
        </li>

        <li class="nav-item">
          <a class="custom-nav-link" href="{{ url('services') }}">Services</a>
        </li>
        <li class="nav-item">
          <a class="custom-nav-link" href="{{ url('about') }}">About Us</a>
        </li>
        <li class="nav-item">
          <a class="custom-nav-link" href="{{ url('contact') }}">Contact Us</a>
        </li>    
        <li class="nav-item">
            <a class="custom-nav-link" href="{{ route('login') }}"> LogIn
                <!-- <button type="button" class="btn btn-outline-secondary text-white btn-sm">Log In</button> -->
            </a>
        </li>   
      </ul>
    </div>  
  </nav>