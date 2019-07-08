

<template>
    <div class="container">
        <div class="row justify-content-center">


            <div class="col-md-12 mt-3">

                <div class="card card-widget widget-user">

                    <div class="profile-header-cover">
   
                    </div>

                    <div class="widget-user-image">
                        <img v-if="form.profile_pic!='user.png'" class="img-circle" :src="getProfilePic()" alt="User Avatar">
                    </div>

                    <div class="card-footer">
                        <div class="row">
                        <div class="col-sm-4 border-right">
                            <div class="description-block">
                                <h5 class="description-header">Phone</h5>
                                <span class="text">{{form.phone}}</span>
                            </div>
               
                        </div>
               
                        <div class="col-sm-4 border-right">
                            <div class="description-block">
                            <h5 class="description-header"> {{form.name}} </h5>
                            <span class="description-text"> {{form.role}} </span>
                            </div>
                 
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-4">
                            <div class="description-block">
                            <h5 class="description-header">Email</h5>
                            <span class="text">{{form.email}}</span>
                            </div>
             
                        </div>
         
                        </div>
               
                    </div>
                </div>
          

            </div>
        </div>

    <!-- User Profile Settings -->
    <div class="row justify-content-center">
        <div class="col-md-12 mt-3">

            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  <li class="nav-item"><a class="nav-link active show" href="#settings" data-toggle="tab">Profile Settings</a></li>
                  <!-- <li class="nav-item"><a class="nav-link active show" href="#myRoute" data-toggle="tab">Activity</a></li>
                  <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Timeline</a></li> -->
                </ul>
              </div><!-- /.card-header -->

              <div class="card-body">

                <div class="tab-content">

                  <!-- <div class="tab-pane active show" id="myRoute">
                  </div>

                  <div class="tab-pane" id="timeline">
                        <h1>Timeline</h1>
                  </div> -->


                  <div class="tab-pane active show" id="settings">
                      
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
                baseURL: Vue.prototype.$baseURL,
                form: new Form({
                admin_id: '',
                role_id:'',
                name : '',
                email: '',
                phone: '',
                password: '',
                profile_pic: '',

                role:'',
            })

            }
        },
        mounted() {
            console.log('Component mounted.')
        },
        methods:{
            updateInfo(){
                this.form.put('/admin/admin_id')
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
                let file = element.target.files[0];    //let file == var file
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
            axios.get("/adminProfile")
            .then( ({ data }) => (this.form.fill(data)) );
        }
    }
</script>