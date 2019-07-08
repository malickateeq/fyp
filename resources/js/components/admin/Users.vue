
<template>
<!--  Template tag should have only one child (div)  -->
    <div class="container">
    
    <!-- SEARCH FORM -->
    <div class="row">
    <div class="col-md-4">
      <div class="input-group input-group-sm mt-5">
          <!-- Replace @keyup with @keyup.enter in order to stop instant searches -->
        <input class="form-control form-control-navbar" v-model="search" @keyup="searchRec"
         type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-navbar" @click="searchRec">
            <i class="fa fa-search"></i>
          </button>
        </div>
      </div>
    </div>
    </div>


    <div class="row mt-2">

        <div class="col-md-12">
        <div class="card">
            <div class="card-header">
            <h3 class="card-title"> Registered Users</h3>

            <div class="card-tools">
                <button class="btn btn-success" @click="newModal">
                    Add New <i class="fa fa-user-plus"></i>
                </button>
            </div>
            
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
            <table class="table table-hover">

                <tbody>
                <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Created At</th>
                <th>Modify</th>
                </tr>
                <!-- Insert dynamic data in table -->

                <tr v-for="user in users.data" :key="user.id">
                <td>{{user.user_id}}</td>
                <td>{{user.name}}</td>
                <td>{{user.email}}</td>
                <td>{{user.role | upText}}</td>  
                <td>{{user.created_at | regDate}}</td>  
                <td>
                    <a href="#" @click="editModal(user)">
                        <i class="fa fa-edit"></i>
                    </a>
                        |
                    <a href="#" @click="deleteUser(user.user_id)">
                        <i class="fa fa-trash"></i>
                    </a>
                </td>
                </tr>


            </tbody></table>
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <pagination :data="users" 
                @pagination-change-page="getResults">
                </pagination>
            </div>

        </div>
        <!-- /.card -->
        </div>

    </div>

            <!-- Add New Modal -->
        <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addNewLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 v-show="!editMode" class="modal-title" id="addNewLabel"> Add New User </h5>
                <h5 v-show="editMode" class="modal-title" id="addNewLabel"> Update User's Info </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form @submit.prevent="editMode ? updateUser() : createUser()">

            <div class="modal-body">

                <div class="form-group">
                    <input v-model="form.name" type="text" name="name"
                        placeholder="Name"
                        class="form-control" :class="{ 'is-invalid': form.errors.has('name') }">
                    <has-error :form="form" field="name"></has-error>
                </div>

                <div class="form-group">
                    <input v-model="form.email" type="text" name="email"
                        placeholder="Email"
                        class="form-control" :class="{ 'is-invalid': form.errors.has('email') }">
                    <has-error :form="form" field="email"></has-error>
                </div>

                <div class="form-group">
                    <input v-model="form.password" type="text" name="password"
                        placeholder="Password"
                        class="form-control" :class="{ 'is-invalid': form.errors.has('password') }">
                    <has-error :form="form" field="password"></has-error>
                </div>


                <div class="form-group">
                    <select name="role" value="Select User Role" v-model="form.role" id="role" class="form-control" :class="{ 'is-invalid': form.errors.has('role') }">
                        <option value="admin">Admin</option>
                        <option value="rider">Rider</option>
                        <option value="driver">Service Provider</option>
                    </select>
                    <has-error :form="form" field="role"></has-error>
                </div>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button v-show="editMode" type="submit" class="btn btn-primary"> Update </button>
                <button v-show="!editMode" type="submit" class="btn btn-primary"> Create </button>
            </div>

            </form>

            </div>
        </div>
        </div>


    </div>
</template>

<script>
    export default {

        data() {
            return {
                baseURL: Vue.prototype.$baseURL,
                editMode: false,
                search: '',
                users:{},
                form: new Form({
                    id: '',
                    user_id:'',
                    name : '',
                    email: '',
                    password: '',
                    role: ''
                })
            }
        },

        methods:{
            searchRec(){
                axios.get('/findUser?q=' + this.search)
                .then( (data)=>{
                    this.users = data.data;
                })
                .catch( ()=>{

                })
            },
            getResults(page = 1) {
                    axios.get('/getUsers?page=' + page)
                    .then(response => {
                        this.users = response.data;
                    });
		    },
            updateUser(){
                this.form.post('/updateUser').then( ()=>{
                    //Close form
                    $('#addModal').modal('hide');
                    //Show success modal
                            Swal.fire(
                            'Updated!',
                            'User data has been updated.',
                            'success'
                            )
                    Fire.$emit('reloadUsers');
                })
                .catch( ()=>{
                    //fail
                } )
            },
            //New Modal for Register
            newModal(){
                this.editMode = false;
                this.form.reset(); //So that it will not show already filled values in reg form
                $('#addModal').modal('show');
            },
            //Modal for Edit User
            editModal(user){
                this.editMode = true;
                $('#addModal').modal('show');
                this.form.reset();
                this.form.fill(user);
            },
            //Create a new user
            createUser(){
                this.form.post('/addNewMember')
                .then( ()=>{
                    $('#addModal').modal('hide');
                    toast.fire({
                    type: 'success',
                    title: 'User created successfully'
                    });
                    Fire.$emit('reloadUsers');
                })
                .catch( ()=>{
                })    
            },
            loadUsers(){
                axios.get("/getUsers").then(({ data }) => (this.users = data));
            },
            deleteUser(id){
                    Swal.fire({
                        title: 'Are you sure?',
                        text: "You won't be able to revert this!",
                        type: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                        if (result.value) {
                            //Sent request to the server
                            this.form.get('/deleteUser/'+ id).then(()=>{})
                            Swal.fire(
                                'Deleted!',
                                'User has been deleted.',
                                'success'
                            )
                        }
                        Fire.$emit('reloadUsers');
                    }).catch( ()=>{
                        //Swal ("Failed", "There was something wrong!", "Warning");
                        alert ("There was something wrong!"); 
                    } );
            }

        },//End of methods

        created() {
            //Load table data at startup
            this.loadUsers();
            Fire.$on('reloadUsers', ()=>{
                this.loadUsers();
            });
            // //Refresh table data in every 3 seconds
            // setInterval( ()=>this.loadUsers(), 3000);
        }
    }
</script>
