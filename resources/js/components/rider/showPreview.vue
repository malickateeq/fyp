
<template>
    <div class="container">
        <div class="row justify-content-center">

            <!-- User profile header -->
            <div class="col-md-12 mt-3">
                    <!-- Widget: user widget style 1 -->
                <div class="card card-widget widget-user">

                    <!-- Add the bg color to the header using any of the bg-* classes -->
                    <div class="profile-header-cover">
                        <!-- Cover Photo Refer to profil-header CSS internal CSS -->
                    </div>

                    <div class="widget-user-image">
                        <img class="img-circle"  v-if="profile.profile_pic!='user.png'" :src="getProfilePic()" alt="User Avatar">
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
                                        <button @click.prevent="showMyRoute" class="btn btn-primary mt-3" id="showRoute"> <i class="fa fa-map-marker"></i> Show Route </button>
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
                                </div><!-- /.card-body -->
                                </div>

                            </div>
                        </div>
                        <!-- End of Info Panel -->

                            <GmapMap
                                ref="map"
                                :center="{lat: 33.738045, lng: 73.084488}"
                                :zoom="12"
                                style="width: 100%; height: 500px"
                            >
                            </GmapMap>

                    <button class="btn btn-success text-center btn-lg my-5" @click="bookNow()"> Book Now </button>
            </div>
        </div>


    </div>
</template>

<script>


    export default {
            props: ['prevId'],
        data(){
            return {
                baseURL: Vue.prototype.$baseURL,
                
                directionsService:  '',
                directionsDisplay:  '',

                profile:{},
                //Google maps Vue2
                form: new Form({
                driver_id: '',
                role_id:'',
                name : '',
                email: '',
                phone: '',
                password: '',
                profile_pic: '',
                
                //Google MAps Directions Data
                startAddr: '',
                endAddr:  '',
                distance: '',
                duration: '',
                wayPoints: '',
                origin: '',
                destination: '',

                role: '',
                startAddr: '',
                endAddr: '',
                distance: '',
                duration: '',
                wayPoints: '',
                origin: '',
                destination: '',

                //Ride Info
                departure_time: '',
                arrival_time: '',
                total_seats: '',
                reserved_seats: '',
                v_type: '',
                passengers: '',

            })

            }
        },
        methods:{
            bookNow(){
                // let id = this.property.user_id;
                // axios.post('/chat', {id})
                // .then( response => {
                // });
                console.log("My Id: "+this.profile.myId+", Friend: "+ this.profile.friendId );
                // this.$get.myId = this.me.id;
                // this.$get.friendId = this.property.user_id;
                Vue.prototype.$myId = this.profile.myId;
                Vue.prototype.$friendId = this.profile.friendId;
                // console.log(this.$get.myId+' to '+ this.$get.friendId);
                // this.$router.push({ path: '/chat/'+this.me.id+'/'+this.property.user_id });
                this.$router.push({ name: 'chat', params: {myId: this.profile.myId, friendId: this.profile.friendId }});
                // window.location.href = 'renterDash#/chat/'+this.property.user_id;
            },
            showMyRoute(){
                let from = this.profile.origin;
                let to = this.profile.destination;
                
                from = from.split(',');
                to = to.split(',');
                this.profile.origin = new google.maps.LatLng(from[0],from[1]);
                this.profile.destination = new google.maps.LatLng(to[0],to[1]);

                if(this.profile.wayPoints!=null)
                {
                    this.calcRoute();
                }else{
                    this.showRoute();
                }
            },
            showRoute(){
                this.$gmapApiPromiseLazy().then(() => {
                    const _self = this;

                    this.directionsService.route({
                        origin: this.profile.origin,
                        destination: this.profile.destination,
                        travelMode: 'DRIVING',
                        avoidTolls: true
                    }, (response, status) => {
                        if (status === 'OK') {
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
                    wp = this.calculateWayPoints(this.profile.wayPoints);
                    this.directionsService.route({
                        origin: this.profile.origin,
                        destination: this.profile.destination,
                        waypoints: wp,
                        travelMode: 'DRIVING',
                        avoidTolls: true,
                    }, (response, status)=> {
                    if (status === 'OK') {
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
                console.log(wayP);
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
            getProfilePic(){
                let pic = this.baseURL+"/img/profile/"+ this.profile.profile_pic ;
                return pic;
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

                            let wp =[];
                            for(let i=0;i<wayPoint.length;i++)
                            {
                                wayPoint[i] = [wayPoint[i].lat(),wayPoint[i].lng()];
                                //Display
                                wp[i] =  wayPoint[i] +',,';
                                _self.form.wayPoints = wp;
                            } 
                    });

                });
            },
        },
        created(){
            //Get preview
            axios.get("/getPreview?q="+ this.prevId)
            .then( 
                ({ data }) => (this.profile=data),
             );
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

        },//end of mounted

    }
</script>