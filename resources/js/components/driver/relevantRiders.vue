<template>
    <div class="container">
        <div class="row justify-content-center">
            
            <div class="col-md-12 my-5">

                        <div v-for="ride in routes" v-bind:key="ride.id">

                            <div class="card my-5">
                                <div class="card-header text-center">
                                       <b> Posted By: </b> {{ride.name}}
                                </div>

                                <div class="card-body">
                                    <b> From: </b>  {{ride.startAddr }} <br>
                                    <b> To: </b>  {{ride.endAddr }} <br><br>
                                    <router-link :to="{ name: 'riderPreview', params: {prevId: ride.id}}" class="btn btn-primary"> Preview </router-link>
                                </div>

                                <div class="card-footer text-muted text-center">
                                       <b>Created At: </b> {{ride.created_at}} |
                                       <b>  Updated:  </b> {{ride.updated_at | timeAgo}}
                                </div>

                            </div>

                        </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return {
                routes:{},
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

                departure_time: '',
                arrival_time: '',
                v_type: '',
                fare: '',
                }),
            }
        },
        methods:{
        },
        created(){
            //Get current logged in profile data
            axios.get("/driverProfile")
            .then( ({ data }) => (this.form.fill(data)) );

            //Get All Rides
            this.form.post('/getRelevantRiders')
            .then(
                //Get all routes data
                ({ data }) => (
                    this.routes=data
                    )
            )

        },
        mounted() {
            console.log('Component mounted.')
        },
    }
</script>
