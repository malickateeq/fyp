
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title> {{ Auth::user()->name }} </title>

    <!-- It refers to /public/css/app.css -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

</head>

<body class="hold-transition sidebar-mini">
<div class="wrapper" id="app">

  <!-- Navbar-->
  <nav class="main-header navbar navbar-expand bg-white navbar-light border-bottom">

    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="./img/user.png"><i class="fa fa-bars"></i></a>
      </li>

    </ul>


    <!-- SEARCH FORM -->
    <form class="form-inline ml-3">
      <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-navbar" type="submit">
            <i class="fa fa-search"></i>
          </button>
        </div>
      </div>
    </form>



  </nav>

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href=" {{ url('/')}} " class="brand-link">
      <img src="./img/white-logo.png" alt="Pick n Ride Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light"> Pick n Ride </span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="./img/user.png" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <router-link to="/driverProfile" class="d-block">  {{ Auth::user()->name }} </router-link>
        </div>
      </div>

      <!-- Sidebagr Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

            <li class="nav-item">
            <router-link to="/relevantRiders" class="nav-link">
              <i class="nav-icon fa fa-tachometer"></i>
              <p>
                Relevant Riders
              </p>
            </uter-link>
          </li>

          <li class="nav-item">
              <router-link to="/chat" class="nav-link">
                <i class="fa fa-comments nav-icon"></i>
                <p> Messages</p>
              </uter-link>
          </li>

          <li class="nav-item ">
            <router-link to="/sth" class="nav-link">
              <i class="nav-icon fa fa-cog"></i>
              <p>
                Settings
              </p>
            </router-link>
          </li>

                    
          <li class="nav-item">
            <router-link to="/driverProfile" class="nav-link">
              <i class="nav-icon fa fa-user"></i>
              <p>
                Profile
              </p>
            </router-link>
          </li>

                    
          <li class="nav-item">
                <a class="nav-link" href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                                 document.getElementById('logout-form').submit();">
                                 
              <i class="nav-icon fa fa-power-off"></i>
                  <p>
                    {{ __('Logout') }}
                  </p>
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>

          </li>


        </ul>
      </nav>
    </div>
  </aside>

  <!-- Wrapper. Contains page content -->
  <div class="content-wrapper">

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
          <router-view> </router-view>
      </div>
    </div>
 
  </div>

  
   <!-- Include small footer -->
   @include('includes.smallFooter')

</div>


<!-- REQUIRED SCRIPTS -->

<script src="{{ asset('js/app.js') }}" defer></script>

  <!-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAVELSX6ErxUO5vgrxO_z9SHZyf_RvdP3w&libraries=places&callback=initMap"
   defer></script> -->

</body>
</html>
