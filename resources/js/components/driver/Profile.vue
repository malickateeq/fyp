


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
                        <img class="img-circle"  v-if="form.profile_pic!='user.png'" :src="getProfilePic()" alt="User Avatar">
                    </div>

                    <div class="card-footer">
                        <div class="row">
                        <div class="col-sm-4 border-right">
                            <div class="description-block">
                                <h5 class="description-header">Phone</h5>
                                <span class="text">{{form.phone}}</span>
                            </div>
                            <!-- /.description-block -->
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-4 border-right">
                            <div class="description-block">
                            <h5 class="description-header"> {{form.name}} </h5>
                            <span class="description-text"> {{form.role}} </span>
                            </div>
                            <!-- /.description-block -->
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-4">
                            <div class="description-block">
                            <h5 class="description-header">Email</h5>
                            <span class="text">{{form.email}}</span>
                            </div>
                            <!-- /.description-block -->
                        </div>
                        <!-- /.col -->
                        </div>
                        <!-- /.row -->
                    </div>
                </div>
                <!-- /.widget-user -->

            </div>
        </div>


    <!-- User Profile Settings -->
    <div class="row justify-content-center">
        <div class="col-md-12 mt-3">

            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  <li class="nav-item"><a class="nav-link active show" href="#myRoute" data-toggle="tab"> My Route </a></li>
                  <li class="nav-item"><a class="nav-link" href="#rideInfo" data-toggle="tab">Ride Info</a></li>
                  <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Profile Settings</a></li>
                </ul>
              </div><!-- /.card-header -->

              <div class="card-body">

                <div class="tab-content">

                  <div class="tab-pane active show" >
                    <!-- myRoute Info -->
                    <!-- myRoute -->

                        <h4 class="text-center"> Enter your route info </h4>

                        <form enctype="multipart/form-data">

                            <div class="form-group">
                                <label for="StartingPoint"> Starting point: </label>
                                <gmap-autocomplete
                                    :value= form.startAddr
                                    class="form-control"
                                    placeholder="Starting Location"
                                    @place_changed="setStart"
                                    :select-first-on-enter="true">
                                </gmap-autocomplete>
                            </div>

                            <div class="form-group">
                                <label for="EndingPoint"> Ending point: </label>
                                <gmap-autocomplete
                                    :value= form.endAddr
                                    class="form-control"
                                    placeholder="Destination Location"
                                    @place_changed="setEnd"
                                    :select-first-on-enter="true">
                                </gmap-autocomplete>
                            </div>

                                <button @click.prevent="showMyRoute" type="submit" 
                                class="btn btn-primary my-2"> Show Route </button>

                                    <GmapMap ref="map"
                                        :center="{lat: 33.738045, lng: 73.084488}"
                                        :zoom="12"
                                        style="width: 100%; height: 500px;"
                                        class="mb-5"
                                    >
                                    </GmapMap>

                            <!-- Form values to enter in database -->
                            <!-- @csrf  -->
                            <h3 class="text-center my-5"> Route Info  </h3>

                            <div class="form-group">
                                <label for="startAddr"> Start Address: </label>
                                <input v-model="form.startAddr" type="text" id="startAddr"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('startAddr')}" disabled>
                            </div>

                            <div class="form-group">
                                <label for="endAddr"> End Address: </label>
                                <input v-model="form.endAddr" type="text" id="endAddr"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('endAddr')}" disabled>
                            </div>

                            <div class="form-group">
                                <label for="distance"> Distance (km): </label>
                                <input v-model="form.distance" type="text" id="distance"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('distance')}" disabled>
                            </div>

                            <div class="form-group">
                                <label for="duration"> Duration (minutes): </label>
                                <input v-model="this.form.duration" type="text" id="duration"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('duration')}" disabled>
                            </div>
                            
                            <div class="form-group">
                                <input v-model="form.origin" type="text" id="origin" name="origin"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('origin')}" hidden>
                            </div>

                            <div class="form-group">
                                <input v-model="form.destination" type="text" id="destination"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('destination')}" hidden>
                            </div>

                             <div class="form-group">
                                <input v-model="form.wayPoints" type="text" id="wayPoints"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('wayPoints')}" hidden>
                            </div>

                        <button @click.prevent="setDirections" type="submit" class="btn btn-primary"> Update Directions </button>
                        </form>
            
                    <!-- /.myRoute Info -->
                  </div>


                  <!-- /.tab-pane -->
                  <div class="tab-pane" id="rideInfo">
                    <!-- Ride Info -->
                    
                        <form  enctype="multipart/form-data">

                        <h4 class="text-center"> Timing  </h4>
                        
                            <div class="form-group">
                                <label for="departure_time"> Departure Time: </label>
                                <input v-model="form.departure_time" type="time" name="departure_time" 
                                class="form-control" :class="{ 'is-invalid': form.errors.has('departure_time') }">
                            </div>

                            <div class="form-group">
                                <label for="arrival_time"> Arrival Time: </label>
                                <input v-model="form.arrival_time" type="time" name="arrival_time" 
                                class="form-control" :class="{ 'is-invalid': form.errors.has('arrival_time') }">
                            </div>
                            
                        <h4 class="text-center"> Vehicle Info  </h4>

                            <div class="form-group">
                                <label for="total_seats"> Total Seats: </label>
                                <input v-model="form.total_seats" type="number" name="total_seats" 
                                class="form-control" :class="{ 'is-invalid': form.errors.has('total_seats') }">
                            </div>

                            <div class="form-group">
                                <label for="reserved_seats"> Reserved Seats: </label>
                                <input v-model="form.reserved_seats" type="number" name="reserved_seats" 
                                class="form-control" :class="{ 'is-invalid': form.errors.has('reserved_seats') }">
                            </div>

                        
                            <div class="form-group">
                                <label for="total_seats"> Vehicle Type: </label>
                                <select name="v_type" value="Select Vehicle Type" v-model="form.v_type"
                                 class="form-control" :class="{ 'is-invalid': form.errors.has('v_type') }">
                                    <option value="car">Car</option>
                                    <option value="van">Van</option>
                                    <option value="bus">Bus</option>
                                </select>
                                <has-error :form="form" field="v_type"></has-error>
                            </div>

                            <div class="form-group">
                                <label for="total_seats"> Available For: </label>
                                <select name="passengers" value="Select Vehicle Type" v-model="form.passengers"
                                 class="form-control" :class="{ 'is-invalid': form.errors.has('passengers') }">
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                    <option value="male/female">Male/Female</option>
                                </select>
                                <has-error :form="form" field="passengers"></has-error>
                            </div>


                            <button  @click.prevent ="setRideInfo" type="submit" class="btn btn-primary"> Set Ride Info </button>
                            
                            </form>
                  </div>
                  <!-- /.tab-pane -->

                  <div class="tab-pane" id="settings">
                      
                        <form enctype="multipart/form-data">

                            <div class="modal-body col-10">

                                <div class="form-group">
                                    <input v-model="form.name" type="text" name="name"
                                        placeholder="Name"
                                        class="form-control" :class="{ 'is-invalid': form.errors.has('name') }">
                                    <has-error :form="form" field="name"></has-error>
                                </div>

                                <div class="form-group">
                                    <input v-model="form.email" type="text" name="email"
                                        placeholder="Email"
                                        class="form-control" :class="{ 'is-invalid': form.errors.has('email') }" disabled>
                                    <has-error :form="form" field="email"></has-error>
                                </div>

                                <div class="form-group">
                                    <input v-model="form.phone" type="text" name="phone"
                                        placeholder="Phone"
                                        class="form-control" :class="{ 'is-invalid': form.errors.has('phone') }">
                                    <has-error :form="form" field="phone"></has-error>
                                </div>

                                <div class="form-group">
                                    <input v-model="form.password" type="text" name="password"
                                        placeholder="Password"
                                        class="form-control" :class="{ 'is-invalid': form.errors.has('password') }">
                                    <has-error :form="form" field="password"></has-error>
                                </div>


                                <div class="form-group">
                                    <label for="profile pic">Profile Picture</label>
                                    <div class="col-sm10">
                                        <input type="file" @change="convertPic" class="file-input" name="profile_pic">
                                        <has-error :form="form" field="profile_pic"></has-error>
                                    </div>
                                </div>

                            </div>

                            <div class="modal-footer col-10">
                                <button @click.prevent ="updateInfo" type="submit" class="btn btn-primary"> Update </button>
                            </div>

                        </form>
        
                  </div>
                  <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>

        </div>
    </div>

    </div>
</template>

<script>
    export default {
        data(){
            return {
                baseURL: Vue.prototype.$baseURL,
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
                origin: 'b',
                destination: 'b',

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
            showMyRoute(){
            
                let from = this.form.origin;
                let to = this.form.destination;
                from = from.split(',');
                to = to.split(',');
                this.form.origin = new google.maps.LatLng(from[0],from[1]);
                this.form.destination = new google.maps.LatLng(to[0],to[1]);

                if(this.form.wayPoints!=null)
                {
                    this.calcRoute();
                }else if(this.form.origin!=''){
                    this.showRoute();
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

                            let wp ='';
                            for(let i=0;i<wayPoint.length;i++)
                            {
                                wayPoint[i] = [wayPoint[i].lat(),wayPoint[i].lng()];
                                //Display
                                wp +=  wayPoint[i] +',,';
                                _self.form.wayPoints = wp;
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
                    // console.log('2: '+ place.formatted_address);
                    this.showRoute();
                })
            },
            showRoute(){
                this.$gmapApiPromiseLazy().then(() => {
                    const _self = this;

                    this.directionsService.route({
                        origin: this.form.origin,
                        destination: this.form.destination,
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
                    wp = this.calculateWayPoints(this.form.wayPoints);
                    this.directionsService.route({
                        origin: this.form.origin,
                        destination: this.form.destination,
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
            setRideInfo(){
                this.form.post('/setRideInfo')
                .then( ()=>{
                    //Show success modal
                    Swal.fire(
                    'Updated!',
                    'Your profile has been updated.',
                    'success'
                    )
                })
                .catch( ()=>{
                })
            },
            setDirections(){
                this.form.post('/setDriverDirections')
                .then( ()=>{
                    //Show success modal
                    Swal.fire(
                    'Updated!',
                    'Your profile has been updated.',
                    'success'
                    )
                })
                .catch( ()=>{
                })
            },
            updateInfo(){
                this.form.put('/driver/driver_id')
                .then( ()=> {
                    //Show success modal
                    Swal.fire(
                    'Updated!',
                    'Your profile has been updated.',
                    'success'
                    )
                })
                .catch( ()=>{

                });
            },
            convertPic(element){
                //element containing profile pic
                let file = element.target.files[0];    //let file == let file
                //file = contains complete information about file size, type, date, name etc
                console.log(file);
                let reader = new FileReader();  //base64 file encoding
                
                //File sizes 2MB=2097152

                if( file['size'] < 2097152  ){
                    //Change file to base65
                    reader.onloadend = (file) => {
                        this.form.profile_pic = reader.result;
                    }
                    reader.readAsDataURL(file);
                }
                else{
                    Swal.fire({
                        type: 'error',
                        title: 'Oops..',
                        text: 'You are uploading a large file!',
                    })
                }
                
                
            },
            getProfilePic(){
                let pic = (this.form.profile_pic.length > 200) ? this.form.profile_pic : this.baseURL+"/img/profile/"+ this.form.profile_pic ;
                return pic;
            },
        },
        created(){
            axios.get("/driverProfile")
            .then( ({ data }) => (this.form.fill(data)) );
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
        },
        // Custom Maps
        
    }
</script>
