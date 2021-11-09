<template>
<div>
<div class="mt-3 card" 
v-if="active.dashboard">

<div class="card-body">

<h1 class="text-center"><i class="fas fa-user-edit"></i> Manage Users
<div class="float-right btn-group-vertical">
<button class="float-right btn btn-outline-primary btn-sm" @click="setActive('createUser')"><i class="fas fa-user-plus"></i> User</button>
<button class="float-right btn btn-outline-primary btn-sm" @click="setActive('taskList')"><i class="fas fa-tasks"></i> To Do List</button> 
</div>
</h1>
<br><br>
<div class="alert-success alert" role="alert" v-if="success_message !== null">
        {{ success_message }}
</div>

<div class="alert-danger alert" role="alert" v-if="danger_message !== null">
        {{ danger_message }}
</div>

<paginator
 v-if="results !==null"
 v-bind:results="results"
 v-on:get-page="getPage"
>
</paginator>
<paginatorDetails
 v-if="results !==null"
 v-bind:results="results"
></paginatorDetails>
<table class="table table-bordered table-hover">
<thead class="table-secondary">
<tr>
<th>Name</th>
<th>Email</th>
<th>User Since</th>
<th>Action</th>
</tr>
</thead>
<tbody v-if="results !== null ">
<tr v-for="user in results.data" :key="user">
<td>{{ user.name}}</td>
<td>{{ user.email}}</td>
<td>{{ user.user_since}}</td>
<td>
<div class="btn-group btn-group-justified">
<button class="btn btn-secondary btn-sm" title="View User Logs" @click="viewUserLogs(user)"><i class="fas fa-list-alt"></i></button>
<button class="btn btn-sm btn-warning" title="Edit User" @click="editUser(user)">
<i class="fas fa-edit"></i>
</button>
<button class="btn btn-sm btn-secondary" title="Change User Password" @click="changePassword(user)"><i class="fas fa-key"></i></button>
<button class="btn btn-sm btn-danger" title="Delete User" @click="deleteUser(user)">
<i class="fas fa-trash"></i>
</button>
</div>
</td>

</tr>
</tbody>
</table>
<paginatorDetails
 v-if="results !==null"
 v-bind:results="results"
></paginatorDetails>
<paginator
 v-if="results !==null"
 v-bind:results="results"
 v-on:get-page="getPage"
>
</paginator>

</div>
</div>

<CreateUser
 v-if="active.createUser"
 v-on:view-dashboard="setActive('dashboard')"
 v-on:created-user="flashSuccessAndReload"
 >
</CreateUser>

<UserLogs
v-if="user !== null && active.userLogs"
v-bind:user="user"
v-on:view-dashboard="setActive('dashboard')"
>
</UserLogs>

<EditUser
v-if="user !== null && active.editUser"
v-bind:user="user"
v-on:view-dashboard="setActive('dashboard')"
v-on:user-updated="flashSuccessAndReload"
>
</EditUser>

<ChangeUserPassword
v-if="user !== null && active.changePassword"
v-bind:user="user"
v-on:view-dashboard="setActive('dashboard')"
v-on:updated-password="flashSuccessAndReload"
v-on:sent-reset-link="flashSuccessAndReload"
>
</ChangeUserPassword>

<tasklist
v-if="active.taskList"
v-on:view-dashboard="setActive('dashboard')"
>
</tasklist>

<Footer></Footer>

</div>
</template>

<script>
import paginator from '../utilities/pagination/paginator.vue';
import paginatorDetails from '../utilities/pagination/paginatorDetails.vue';
import CreateUser from './CreateUser.vue';
import tasklist from '../tasks/tasklist.vue';
import UserLogs from './logs/UserLogs.vue';
import EditUser from './EditUser.vue';
import ChangeUserPassword from './ChangeUserPassword.vue';
import Footer from '../utilities/Footer/footer.vue';


    export default{
        components:{
            paginator,
            paginatorDetails,
            CreateUser,
            tasklist,
            UserLogs,
            EditUser,
            ChangeUserPassword,
            Footer
        },
        mounted() {
            this.getUsers()
        },
        data(){
            return{
                user:null,
                results: null,
                active:{
                    dashboard:true,
                    createUser:false,
                    taskList:false,
                    userLogs: false,
                    editUser:false,
                    changePassword:false
                },
                params:{
                    page:1
                },
                success_message:null,
                danger_message:null
            }   
        },
        methods: {
            getUsers: function(){
                axios.get('/data/users', {params: this.params}).then(response=>{
                    this.results = response.data.results
                    
                })
            },
            editUser: function(user){
                this.user=user
                this.setActive('editUser')
            },
            changePassword: function(user){
                this.user = user
                this.setActive('changePassword')
            },
            deleteUser: function(user){
                let r = confirm("Are you sure you want to delete "+user.name+" from the systrem?")

                if (r) {
                    axios.post('/data/users/' + user.id,{_method: 'DELETE'})
                    .then(response =>{
                        this.flashSuccessAndReload('Successfully delete user')
                    })
                    .catch(errors =>{
                      if(errors.response.status === 403){
                        this.flashDanger("Unauthorised to delete User")
                        }
                    })
                }
            },
            viewUserLogs: function(user){
                this.user = user
                this.setActive('userLogs')
            },
            getPage: function(event){
                this.params.page=event
                window.scrollTo(0, 0)
                this.getUsers()
            },
            setActive: function(component){
                Object.keys(this.active).forEach(key => this.active[key] = false)
                this.active[component] = true
            },
            flashSuccessAndReload:function(event){
                this.setActive('dashboard')
                this.flashSuccess(event)
                 this.getUsers()
            },
            flashSuccess: function(message){
                this.success_message = message
                setTimeout(()=>{
                    this.success_message = null
                }, 5000)
            },
            flashDanger:function(message){
                this.danger_message = message
                setTimeout(() => {
                    this.danger_message=null
                }, 5000)
            }
        }
    }
</script>