
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
          <router-link to="/adminProfile" class="d-block">  {{ Auth::user()->name }} </router-link>
        </div>
      </div>

      <!-- Sidebagr Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

            <li class="nav-item">
            <router-link to="/dashboard" class="nav-link">
              <i class="nav-icon fa fa-tachometer"></i>
              <p>
                Dashboard
              </p>
            </uter-link>
          </li>

          <li class="nav-item has-treeview">
            <a href="" class="nav-link ">
              <i class="nav-icon fa fa-cog"></i>
              <p>
                Management
                <i class="right fa fa-angle-left"></i>
              </p>
            </a>

            <ul class="nav nav-treeview">
              <li class="nav-item">
                <router-link to="/users" class="nav-link">
                  <i class="fa fa-users nav-icon"></i>
                  <p>Users</p>
                </router-link>
              </li>
              
            </ul>
          </li>

                    
          <li class="nav-item">
            <router-link to="/adminProfile" class="nav-link">
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


</body>
</html>
