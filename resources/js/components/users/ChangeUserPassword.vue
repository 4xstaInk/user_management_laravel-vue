<template>
    <div>
    <div class="card mt-3">
    <div class="card-body">
    <h1 class="text-center"><i class="fas fa-key"></i>Change User Password 
    <br>
     <small class="text-muted">
    <i class="fas fa-user"></i>
    {{user.name}}
    </small>
    </h1>
    <h3>
    <button class="btn btn-outline-primary btn-sm mr-3" @click="$emit('view-dashboard')">
    <i class="fas fa-chevron-left"></i> Back
    </button>
    <hr>
    </h3>
     <div class="alert alert-warning" role="alert"
    v-if="errors.length > 0"
    >
    <ul>
    <li v-for="error in errors">{{error}}</li>
    </ul>
    </div>
<h4 class="text-muted">Click the button to sent the reset link: <button class="btn btn-outline-primary" @click.prevent="sendResetLink">Send Reset Link</button></h4>
<hr>
    <div class="form-group row">
     <label for="" class="col-3">Password</label>
     <div class="col-9">
     <input type="password" v-model="data.password" class="form-control" placeholder="Must contain a lower and uppercase letter, a number and a special character" >
     </div>
    </div>

    <div class="form-group row">
    <label for="" class="col-3">Confirm Password</label>
    <div class="col-9">
    <input type="password" v-model="data.confirm_password" class="form-control">
    </div>
    </div>
<div class="btn-group">

    <button class="btn btn-primary" @click.prevent="updatePassword">Update Password</button>

</div>
   </div>
    </div>
    </div>
</template>

<script>
export default {
    props:['user'],
    data(){
        return{
            data:{
                password:'',
                confirm_password:''
            },
            errors:[]
        }
    },
    methods:{
        updatePassword: function(){
            this.errors=[]
            axios.post('/data/users/updates/password/' + this.user.id, {
                _method:'PUT',
                password: this.data.password,
                confirm_password: this.data.confirm_password
            }).then(response =>{
this.$emit('updated-password',"Successfully updated password for "+this.user.name)
            }).catch(errors=>{
                if(errors.response.status === 422){
                     Object.keys(errors.response.data.errors).forEach(key => {
                    errors.response.data.errors[key].forEach(error=>this.errors.push(error))
                })
                }
                if (errors.response.status === 403) {
                    this.errors.push("Not authorized to change this users password")
                }
            })
        },
        sendResetLink: function(){
           axios.post('/data/users/updates/send-reset-link/' + this.user.id).then(response => this.$emit('sent-reset-link','successfully sent reset link to ' + this.user.name))
        }
        }
    }

</script>