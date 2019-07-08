<template>
    <div class="container">

        <!-- Search bar -->
        <div v-if="searchPanel" class="searchPanel">
            <div class="row shadow my-3 pt-3">

                    <div class="form-group col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <gmap-autocomplete
                            :value= form.startAddr
                            class="form-control"
                            placeholder="Starting Location"
                            @place_changed="setStart"
                            :select-first-on-enter="true">
                        </gmap-autocomplete>
                    </div>

                    <div class="form-group col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <gmap-autocomplete
                            :value= form.endAddr
                            class="form-control"
                            placeholder="Destination Location"
                            @place_changed="setEnd"
                            :select-first-on-enter="true">
                        </gmap-autocomplete>
                    </div>

                    <div class="form-group col-lg-2 col-md-2 col-sm-6 col-xs-12">
                        <button @click.prevent="showMyRoute" type="submit" 
                            class="btn btn-primary"> <i class="fa fa-map-marker"></i> Get Route </button>

                    </div>

                    <div class="form-group col-lg-2 col-md-2 col-sm-6 col-xs-12">

                        <button v-on:click="showRides" type="button" 
                            class="btn btn-primary"> Show relevant rides </button>
                    </div>
            </div>
        </div>
        <!-- Search bar -->



        <!-- Rides results -->
        <div v-if="showRidesPanel" class="showRides">
             <div class="col-md-12 my-5">
                    <div v-for="ride in routes" v-bind:key="ride.id">
                            <div class="card my-5">
                                <div class="card-header text-center">
                                       <b> Posted By: </b> {{ride.name}}
                                </div>

                                <div class="card-body">
                                    <b> From: </b>  {{ride.startAddr }} <br>
                                    <b> To: </b>  {{ride.endAddr }} <br><br>

                                    <button class="btn btn-primary"
                                     v-on:click="showProfile(ride.id)"> Preview </button>
                                
                                </div>

                                <div class="card-footer text-muted text-center">
                                       <b>Created At: </b> {{ride.created_at}} |
                                       <b>  Updated:  </b> {{ride.updated_at | timeAgo}}
                                        
                                </div>
                            </div>
                    </div>
            </div>
        </div>
        <!-- Rides results -->
        

        <!-- Show Profile -->
        <div v-if="showProfilePanel" class="showProfilePanel">
            <!-- User profile header -->
            <div class="col-md-12 mt-3">
                    <!-- Widget: user widget style 1 -->
                <div class="card card-widget widget-user">

                    <!-- Add the bg color to the header using any of the bg-* classes -->
                    <div class="profile-header-cover">
                        <!-- Cover Photo Refer to profil-header CSS internal CSS -->
                    </div>

                    <div class="widget-user-image">
                        <img  v-if="profile.profile_pic!='user.png'" class="img-circle" :src="getProfilePic()" alt="User Avatar">
                    </div>

                    <div class="card-footer">
                        <div class="row">
                        <div class="col-sm-4 border-right">
                            <div class="description-block">
                                <h5 class="description-header">Phone</h5>
                                <span class="description-text">{{profile.phone}}</span>
                            </div>
                            <!-- /.description-block -->
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-4 border-right">
                            <div class="description-block">
                            <h5 class="description-header">  </h5>
                            <span class="description-text"> {{profile.name}} </span>
                            </div>
                            <!-- /.description-block -->
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-4">
                            <div class="description-block">
                            <h5 class="description-header">Email</h5>
                            <span class="description">{{profile.email}}</span>
                            </div>
                            <!-- /.description-block -->
                        </div>
                        <!-- /.col -->
                        </div>
                        <!-- /.row -->
                    </div>
                </div>
                <!-- /.widget-user -->

                        <!-- Information Panel -->
                        <div class="row justify-content-center">
                            <div class="col-md-12 mt-3">

                                <div class="card">
                                <div class="card-header p-2">
                                    <ul class="nav nav-pills">
                                    <li class="nav-item"><a class="nav-link active show" href="#routeInfo" data-toggle="tab"> Route Info </a></li>
                                    <li class="nav-item"><a class="nav-link" href="#rideInfo" data-toggle="tab">Ride Info</a></li>
                                    <li class="nav-item"><a class="nav-link" href="#driverInfo" data-toggle="tab">Driver Info</a></li>
                                    </ul>
                                </div><!-- /.card-header -->

                                <div class="card-body">

                                    <div class="tab-content">

                                    <div class="tab-pane active show" id="routeInfo">
                                        <!-- RouteInfo -->                                        
                                        <b>From: </b> {{profile.startAddr}} <br>
                                        <b>To: </b> {{profile.endAddr}}  <br>
                                        <!-- <b>Stops:</b>  {{profile.stops}} <br> -->
                                        <button @click.prevent="showDriverRoute" class="btn btn-primary mt-3" id="showRoute"> <i class="fa fa-map-marker"></i> Show Route </button>
                                        <!-- /.routeInfo -->
                                    </div>


                                    <div class="tab-pane" id="rideInfo">
                                        <!-- ride Info -->
                                        <h3>Timings</h3>

                                        <b>Arrival Time: </b> {{profile.arrival_time}} <br>
                                        <b>Departure Time: </b> {{profile.departure_time}} <br>

                                        <h3>Vehicle Info</h3>

                                        <b>Vehicle Type: </b> {{profile.v_type}} <br>
                                        <b>Available For: </b> {{profile.passengers}} <br>
                                        <b>Total Seats: </b> {{profile.total_seats}} <br>
                                        <b>Reserved Seats: </b> {{profile.reserved_seats}} <br>

                                        <!-- ride Info -->
                                    </div>

                                    <div class="tab-pane" id="driverInfo">
                                        <!-- Driver Info -->
                                        
                                        <h3>Driver Info</h3>
                                        
                                        <b>Name: </b> {{profile.name}} <br>
                                        <b>Phone: </b> {{profile.phone}} <br>
                                        <b>Email: </b> {{profile.email}} <br>

                                        <!-- Driver Info -->
                            
                                    </div>

                                    </div>
                                </div>
                                </div>

                            </div>
                        </div>
                        <!-- End of Info Panel -->
            </div>
        </div>
              <!-- Show Profile -->

              
        <!-- Google Maps -->
        <div v-if="showMap" class="googleMap">
            <GmapMap ref="map"
                :center="{lat: 33.738045, lng: 73.084488}"
                :zoom="12"
                style="width: 100%; height: 500px;"
                class="my-5"
            >
            </GmapMap>
        </div>
        <!-- Google Maps -->

    </div>
</template>

<script>
// import showPreview from'./showPreview.vue';
    export default {
                // components:{
                //     'showPreview': showPreview, 
                //     'showRides': showRides,
                // },
        data(){
            return {
                baseURL: Vue.prototype.$baseURL,
                center: {lat: 33.738045, lng: 73.084488},
                searchPanel: true,
                showRidesPanel: false,
                showProfilePanel: false,
                showMap: true,
                routes:{}, //Holds public rides data
                profile:{}, //Holds a profile data
                directionsService:  '',
                directionsDisplay:  '',

                form: new Form({
                    rider_id: '',
                    role_id:'',
                    name : '',
                    email: '',
                    phone: '',
                    password: '',
                    profile_pic: '',
                    role: '',
                    //Google MAps Directions Data
                    startAddr: '',
                    endAddr:  '',
                    distance: '',
                    duration: '',
                    wayPoints: '',
                    origin: '',
                    destination: '',
                    stops: '',

                    departure_time: '',
                    arrival_time: '',
                    v_type: '',
                    fare: '',
            }),

            }
        },
        methods:{
            showDriverRoute(){
                this.showMap = true;
                
                let from = this.profile.origin;
                let to = this.profile.destination;
                
                from = from.split(',');
                to = to.split(',');
                this.profile.origin = new google.maps.LatLng(from[0],from[1]);
                this.profile.destination = new google.maps.LatLng(to[0],to[1]);

                this.form.origin = this.profile.origin;
                this.form.destination = this.profile.destination;
                if(this.profile.wayPoints!=null)
                {
                    this.form.wayPoints = this.profile.wayPoints;
                    this.calcRoute();
                }else{
                    this.showRoute();
                }
            },
            showRides(){
                if(this.form.origin!='' && this.form.destination!='')
                {
                    //Hide other components
                    this.showRidesPanel= true;
                    this.showMap= false;
                    this.getPublicRides();
                }

            },
            showProfile(id){
                //Hide other components
                this.searchPanel = false;
                this.showRidesPanel = false;
                //Get profile
                    axios.get("/getPreview?q="+ id)
                    .then( 
                        ({ data }) => (this.profile=data),
                        this.showProfilePanel = true,
                    );
            },
            getProfilePic(){
                let pic = this.baseURL+"/img/profile/"+ this.profile.profile_pic ;
                return pic;
            },
            showMyRoute(){
                if(this.form.startAddr!='' && this.form.endAddr!='')
                {
                    //Hide other components
                    this.showRidesPanel= false;
                    this.showMap= true;
                    this.directionsDisplay.setMap(this.$refs.map.$mapObject);
                    this.initialize();
                    this.showProfilePanel = false;
                    
                    let from = this.form.origin;
                    let to = this.form.destination;
                    
                    from = from.split(',');
                    to = to.split(',');
                    this.form.origin = new google.maps.LatLng(from[0],from[1]);
                    this.form.destination = new google.maps.LatLng(to[0],to[1]);

                    if(this.form.wayPoints!=null)
                    {
                        this.calcRoute();
                    }else{
                        this.showRoute();
                    }
                }
            },
            initialize(){
                    this.$gmapApiPromiseLazy().then(() => {
                    const _self = this;
                    //Dragged action listener
                    this.directionsDisplay.addListener('directions_changed', function(e) {
                        let result = _self.directionsDisplay.getDirections();
                        let wayPoint = result.routes[0].legs[0].via_waypoints;
                        let legs = result.routes[0].legs;
                        let stops = '';

                        //Start Location
                        // console.log(_self.form.startAddr);
                        _self.form.startAddr = legs[0].start_address;
                        _self.form.origin = legs[0].start_location.toUrlValue(7);

                        //Calculate distance and time
                        let totalDistance = 0;
                        let totalDuration = 0; 

                        let i=0;
                        for (i=0;i<legs.length;i++) {

                            stops += legs[i].end_address + ' | ';

                            totalDistance += parseInt(legs[i].distance.value/1000, 10);
                            totalDuration += parseInt(legs[i].duration.value/60, 10);

                            _self.form.distance = totalDistance;
                            _self.form.duration = totalDuration;

                            //End Location
                            _self.form.endAddr = legs[i].end_address;
                            _self.form.destination = legs[i].end_location.toUrlValue(7);
                        } 
                        _self.form.stops = stops;

                        let wp='';
                        for(let i=0;i<wayPoint.length;i++)
                        {
                            wayPoint[i] = [wayPoint[i].lat(),wayPoint[i].lng()];
                            //Display
                            wp +=  wayPoint[i] +',,';
                            this.form.wayPoints = wp;
                        } 

                    });

                });
            },
            setStart(place){  
                
                this.$gmapApiPromiseLazy().then(() => {
                    this.form.origin = 
                        place.geometry.location.lat()+','+
                        place.geometry.location.lng();

                    this.form.startAddr = place.formatted_address;
                    // console.log('1: '+ place.formatted_address);
                    this.center= this.form.origin;
                })
            },
            setEnd(place){
                this.$gmapApiPromiseLazy().then(() => {
                    this.form.destination = 
                        place.geometry.location.lat()+','+
                        place.geometry.location.lng();

                    this.form.endAddr = place.formatted_address;
                    this.form.wayPoints = '';
                })
                // if(this.form.startAddr!='' && this.form.endAddr!=''){
                //     //Hide other components
                //     this.showRidesPanel= false;
                //     this.showMap= true;
                //     this.showProfilePanel = false;
                //     this.showRoute();
                // }
            },
            showRoute(){
                this.$gmapApiPromiseLazy().then(() => {
                    // alert('im here to set route');
                    const _self = this;
                    this.directionsService.route({
                        origin: this.form.origin,
                        destination: this.form.destination,
                        travelMode: 'DRIVING',
                        avoidTolls: true
                    }, (response, status) => {
                        if (status === 'OK') {
                            _self.directionsDisplay.setMap(this.$refs.map.$mapObject);
                            _self.directionsDisplay.setDirections(response);
                        
                        } else {
                            window.alert('Directions request failed due to ' + status);
                        }
                    })

                });
            },
            calcRoute() {
                    let wp = [];
                    const _self = this;
                    wp = this.calculateWayPoints(this.form.wayPoints);
                    this.directionsService.route({
                        origin: this.form.origin,
                        destination: this.form.destination,
                        waypoints: wp,
                        travelMode: 'DRIVING',
                        avoidTolls: true,
                    }, (response, status)=> {
                    if (status === 'OK') {
                        
                        _self.directionsDisplay.setMap(this.$refs.map.$mapObject);
                        _self.directionsDisplay.setDirections(response);
                    } else {
                        window.alert('Directions request failed due to ' + status);
                    }
                    });
            },
            calculateWayPoints(wayP){
                let wp = [];
                let wayPoints = [];
                let latLng = [];
                wp = wayP.split(',,');
                let length = wp.length-1;
                for(let i=0; i<length; i++)
                {
                    latLng = wp[i].split(',');
                    wayPoints.push({
                    location: new google.maps.LatLng(latLng[0],latLng[1]),
                    stopover: true
                    });
                }
                return wayPoints;
            },
            getPublicRides(){
                //Get All Rides
                this.form.post('/getPublicRides')
                .then(
                    //Get all routes data
                    ({ data }) => (
                        this.routes=data
                        )
                )
            }
        },
        mounted() {
            //Initialize google maps components
            this.$gmapApiPromiseLazy().then(() => {
                
                const _self = this;
                this.directionsService =  new google.maps.DirectionsService();
                this.directionsDisplay = new google.maps.DirectionsRenderer({
                    draggable: true,
                    map: this.$refs.map.$mapObject,
                });

                //Dragged action listener
                this.initialize();
             });
        }
    }
</script>
