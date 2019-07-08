<template>
    <div class="container-fluid my-5">
    <!-- Template start -->
        <!-- Stats bar -->
<div class="row">

          <div class="col-12 col-sm-6 col-md-3">

            <div class="info-box mb-3">
              <span class="info-box-icon bg-warning elevation-1"> <i class="fa fa-car"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Drivers</span>
                <span class="info-box-number"> {{form.total_drivers}} </span>
              </div>

            </div>

          </div>


          <div class="col-12 col-sm-6 col-md-3">

            <div class="info-box">
              <span class="info-box-icon bg-info elevation-1"><i class="fa fa-users"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Users</span>
                <span class="info-box-number">
                  {{form.total_users}}
                  <small></small>
                </span>
              </div>

            </div>

          </div>




          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-danger elevation-1"><i class="fa fa-road"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Routes</span>
                <span class="info-box-number">{{form.total_routes}}</span>
              </div>

            </div>

          </div>



        </div>

    <!-- End template -->
    </div>
</template>

<script>
    export default {
        data(){
            return {
                form: new Form({
                temp:'',
                total_drivers: '',
                total_users: '',
                total_riders: '',
                total_admins: '',
                total_routes: '',
                role_id:'',
                name : '',
                email: '',
                phone: '',
                password: '',
                profile_pic: ''
            })

            }
        },
        methods:{

        },
        mounted() {
            console.log('Component mounted.')
        },
        created(){
            axios.get("/getStats")
            .then( ({ data }) => (this.form.fill(data)) );
        },
    }
</script>
