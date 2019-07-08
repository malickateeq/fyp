<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title> Search Ride
    </title>

    <!-- It refers to /public/css/app.css -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

</head>
<body>

  <!-- Insert navigation bar -->
  @include('includes.navbar')

  <div style="margin: 150px 0px"></div>
  
  <div id="search-app">
    <div class="container-fluid">
      <keep-alive>
          <public-rides> </public-rides>
      </keep-alive>
    </div>
  </div>



   <script src="{{ asset('js/app.js') }}" defer></script>

    @include('includes.footer')

</body>
</html>