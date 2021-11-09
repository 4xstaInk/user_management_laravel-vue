<template>
    <div>
    <div class="card mt-3">
    <div class="card-body">
    <button class="btn btn-outline-primary btn-sm mr-3" @click="$emit('view-dashboard')"><i class="fas fa-chevron-left mr-1"></i> Back</button>
     <h1 class="text-center">Update Email</h1>
    <hr>

    <div class="alert alert-warning" role="alert" v-if="errors.length > 0">
    <ul>
    <li v-for="error in errors"> {{error}} </li>
    </ul>
    </div>
    <h3 class="text-muted"><i class="fas fa-envelope"></i> {{user.email}}</h3>
    <hr>
    <div class="form-group row">
    <label for="" class="col-3">New Email</label>
    <div class="col-9">
    <input type="email" class="form-control" v-model="data.email">
    </div>
    </div>
    <div class="form-group row">
    <label for="" class="col-3">Enter Password to Comfirm</label>
    <div class="col-9">
    <input type="password" v-model="data.password" class="form-control">
    </div>
    </div>
    <button class="btn btn-primary" @click.prevent="updateEmail">Update Email</button>
    </div>
    </div>
    <Footer></Footer>
    </div>
</template>

<script>
import Footer from '../utilities/Footer/footer.vue';

export default {
    components:{
        Footer
    },
    mounted(){
        this.data.email = this.user.email
    },
    props:['user'],
    data(){
        return{
            data:{
                email:'',
                password:''
            },
            errors:[]
        }
    },
    methods:{
        updateEmail: function(){
            this.errors = []
            axios.post('/data/accounts/updates/email/' + this.user.id,{
                _method:'PUT',
                email: this.data.email,
                password:this.data.password
            }).then(response => {
                this.$emit('updated-email', 'Successfully updated the email for '+ this.user.name)
            }).catch(errors => {
                console.dir(errors)
                if (errors.response.status === 403) {
                    this.errors.push("Please Enter The Correct Passord , Changes will only be made when you enter the correct password")
                }
                if (errors.response.status === 422) {
                    var consoleErrors = errors.response.data.errors;

                    Object.keys(consoleErrors).forEach(key => {
                        consoleErrors[key].forEach(err => this.errors.push(err))
                    })
                }
            })
        }
    }
}
</script>