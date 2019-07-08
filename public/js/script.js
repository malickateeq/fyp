// This example requires the Places library. Include the libraries=places
// parameter when you first load the API. For example:
// <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">

function initMap() {

  //Direction Services
  var directionsService = new google.maps.DirectionsService;
  
  var directionsDisplay = new google.maps.DirectionsRenderer({
    draggable: true,
  });
  
  //End Direction Services
  var map = new google.maps.Map(document.getElementById('map'), {
    center: {
      lat: 33.738045, 
      lng: 73.084488
    },
    zoom: 13
  });
  directionsDisplay.setMap(map);
  
  //Origin and destination autofill search field
  var orgSearch = new google.maps.places.SearchBox(document.getElementById('origin'));
  var destSearch = new google.maps.places.SearchBox(document.getElementById('destination'));
  
  var origin;
  var destination;
  
  //Place change event on search box change Red Marker Position
  google.maps.event.addListener(orgSearch, 'places_changed', function(){
  
    //Input fields values
    origin = document.getElementById('origin').value;
    destination = document.getElementById('destination').value;
    if(destination == '')
    {
    }else{
      calculateAndDisplayRoute(directionsService, directionsDisplay, origin, destination);
    }
  });
  
  google.maps.event.addListener(destSearch, 'places_changed', function(){
    //Input fields values
    origin = document.getElementById('origin').value;
    destination = document.getElementById('destination').value;
    if(origin == '')
    {
    }else{
      calculateAndDisplayRoute(directionsService, directionsDisplay, origin, destination);
    }
  });
  
  //Dierections dragged

  directionsDisplay.addListener('directions_changed', function(e) {

    var result = directionsDisplay.getDirections();
    var wayPoint = result.routes[0].legs[0].via_waypoints; //get waypoint as a result of a user dragging

    var legs = result.routes[0].legs;
    
    var stops = '';
    
    //Start Location
      // document.getElementById("startAddr").value = legs[0].start_address;
      // stops += legs[0].start_address+' | ';
      document.getElementById("origin").value = legs[0].start_location.toUrlValue(7);

    
    //Calculate distance and time
    var totalDistance=0;
    var totalDuration=0; 

    for (i=0;i<legs.length;i++) {
      
      // stops += legs[i].end_address+' | ';

      totalDistance += parseInt(legs[i].distance.value/1000, 10);
      totalDuration += parseInt(legs[i].duration.value/60, 10);

      //Shows data on HTML page
      // document.getElementById("distance").value = distance; //set input field value
      // document.getElementById("distance").innerHTML = distance; //Set HTML tag value p,div etc

      document.getElementById("distance").value = totalDistance;
      // document.getElementById("duration").value = totalDuration;

      //End Location
      // document.getElementById("endAddr").value = legs[i].end_address;
      document.getElementById("destination").value = legs[i].end_location.toUrlValue(7);
    } 
    // document.getElementById("stops").value = stops;

    wp =[];
    for(var i=0;i<wayPoint.length;i++)
      {
        wayPoint[i] = [wayPoint[i].lat(),wayPoint[i].lng()];
        //Display
        wp[i] =  wayPoint[i] +',';
        document.getElementById("wayPoints").value = wp;
      } 
  });

  //Renderer
  };//End of function inItMap()
  
function calculateAndDisplayRoute(directionsService, directionsDisplay, origin, destination) {
  directionsService.route({
      origin: origin,
      destination: destination,
      waypoints: [],
      travelMode: 'DRIVING',
      avoidTolls: true
  }, function(response, status) {
    if (status === 'OK') {
      directionsDisplay.setDirections(response);
    } else {
      window.alert('Directions request failed due to ' + status);
    }
  });
};

// var origin;
// var destination;

// function initMap() {

//   //Direction Services
//   var directionsService = new google.maps.DirectionsService;

//   var directionsDisplay = new google.maps.DirectionsRenderer({
//     draggable: true,
//   });

//   //End Direction Services
//   var map = new google.maps.Map(document.getElementById('map'), {
//     center: {
//       lat: 33.738045, 
//       lng: 73.084488
//     },
//     zoom: 13
//   });
//   directionsDisplay.setMap(map);

// // Try HTML5 geolocation.
// //Could not work because of security issues location only supports HTTPS

//   //Input fields values external request
//   origin = document.getElementById('origin').value;
//   destination = document.getElementById('destination').value;
//   waypoints = document.getElementById('wayPoints').value;
//   // console.log(origin);
//   // console.log(destination);
//   // console.log(waypoints);
//   var wp = [];
//   if(wp!=null)
//   {
//     wp = calculateWayPoints(waypoints);
//     calculateAndDisplayRoute(directionsService, directionsDisplay, wp);
//     //end of external request
//   }
//   else{
//     calculateAndDisplayRoute(directionsService, directionsDisplay);
//   }
  
//   //Origin and destination autofill search field
//   var orgSearch = new google.maps.places.SearchBox(document.getElementById('origin-search'));
//   var destSearch = new google.maps.places.SearchBox(document.getElementById('destination-search'));

//   // //For Public Search
//   // var orgSearch = new google.maps.places.SearchBox(document.getElementById('from'));
//   // var destSearch = new google.maps.places.SearchBox(document.getElementById('to'));
//   //Origin and destination autofill search field
  


//   //Place change event on search box change Red Marker Position
//   google.maps.event.addListener(orgSearch, 'places_changed', function(){

//     //Input fields values
//     origin = document.getElementById('origin-search').value;
//     destination = document.getElementById('destination-search').value;

//     if(destination == '')
//     {
//     }else{
//       calculateAndDisplayRoute(directionsService, directionsDisplay);
//     }
    
//   });

//   google.maps.event.addListener(destSearch, 'places_changed', function(){
//     //Input fields values
//     origin = document.getElementById('origin-search').value;
//     destination = document.getElementById('destination-search').value;

//     if(origin == '')
//     {
//     }else{
//       calculateAndDisplayRoute(directionsService, directionsDisplay);
//     }
//   });

//   //Renderer

//   directionsDisplay.addListener('directions_changed', function(e) {
//     var result = directionsDisplay.getDirections();
//     var wayPoint = result.routes[0].legs[0].via_waypoints; //get waypoint as a result of a user dragging

//     var legs = result.routes[0].legs;
    
//     var stops = '';
    
//     //Start Location
//       document.getElementById("startAddr").value = legs[0].start_address;
//       stops += legs[0].start_address+' | ';
//     document.getElementById("origin").value = legs[0].start_location.toUrlValue(7);

    
//     //Calculate distance and time
//     var totalDistance=0;
//     var totalDuration=0; 

//     for (i=0;i<legs.length;i++) {

      
//       stops += legs[i].end_address+' | ';

//       totalDistance += parseInt(legs[i].distance.value/1000, 10);
//       totalDuration += parseInt(legs[i].duration.value/60, 10);

//       //Shows data on HTML page
//       // document.getElementById("distance").value = distance; //set input field value
//       // document.getElementById("distance").innerHTML = distance; //Set HTML tag value p,div etc

//       document.getElementById("distance").value = totalDistance;
//       document.getElementById("duration").value = totalDuration;

//       //End Location
//       document.getElementById("endAddr").value = legs[i].end_address;
//       document.getElementById("destination").value = legs[i].end_location.toUrlValue(7);
//     } 
//     document.getElementById("stops").value = stops;

//     wp =[];
//     for(var i=0;i<wayPoint.length;i++)
//       {
//         wayPoint[i] = [wayPoint[i].lat(),wayPoint[i].lng()];
//         //Display
//         wp[i] =  wayPoint[i] +',';
//         document.getElementById("wayPoints").value = wp;
//       } 
//   });

// };//End of function inItMap()

// //My own docs
// function calculateAndDisplayRoute(directionsService, directionsDisplay) {
//   directionsService.route({
//       origin: origin,
//       destination: destination,
//       waypoints: [],
//       travelMode: 'DRIVING',
//       avoidTolls: true
//   }, function(response, status) {
//     if (status === 'OK') {
//       directionsDisplay.setDirections(response);
//     } else {
//       window.alert('Directions request failed due to ' + status);
//     }
//   });
// };

// function calculateAndDisplayRoute(directionsService, directionsDisplay, waypoints) {
//     directionsService.route({
//         origin: origin,
//         destination: destination,
//         waypoints: waypoints,
//         avoidTolls: true,
//         travelMode: 'DRIVING'
//     }, function(response, status) {
//       if (status === 'OK') {
        
//         directionsDisplay.setDirections(response);
//       } else {
//         //Nothing....
//       }
//     });
// };

// function calculateWayPoints(wayP){
//   var wp = [];
//   var wayPoints = [];
//   var latLng = [];
//   wp = wayP.split(',,');
//   var length = wp.length;
//   for(var i=0; i<length; i++)
//   {
//     latLng = wp[i].split(',');

//     wayPoints.push({
//       location: new google.maps.LatLng(latLng[0],latLng[1]),
//       stopover: true
//     });
//   }
//   return wayPoints;
// };

// //Ready functions
// $(document).ready(function(){


//   $("#show").click(function(){
//     initMap();
//   });

// });

// // End of Panel display and store routes

// $(document).ready(function(){

//   $("#search").click(function(){
//     console.log("asdadasd");
//   });

// });

// $(document).ready(function(){

//   $("#showRoute").click(function(){
//     initMap();
//   });

// });

