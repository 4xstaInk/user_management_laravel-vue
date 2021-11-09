<template>
    <div>
    <Header></Header>
    <h1>Posting Hub</h1>
     <div class="container mt-1">
  <div class="d-flex mb-3">
    <div class="p-2 flex-fill" id="PostingSide">
    <h6 class="ml-1"><i class="fas fa-user mr-2"></i>{{data.name}}</h6>
    <h6 class="ml-1"><i class="fas fa-envelope mr-2"></i>{{data.email}}</h6>
    
<div class="form-group">
  <label for="comment"><i class="fas fa-laptop mr-2"></i>Post:</label>
  <textarea class="form-control" rows="5" id="PostingField" v-model="data.post"></textarea>
</div>
<div class="btn-group">
  <button type="button" class="btn btn-primary" @click.prevent="storePost()">Post</button>
</div>

    </div>
    <div class="p-2 flex-fill bg-warning">
    <ShowPost 
    v-bind:user="this.user"
    ></ShowPost>
    </div>
 
  </div>
    </div>
    </div>
</template>
<script>
import Header from '../homeComponents/header.vue';
import ShowPost from '../post/ShowPost.vue';

export default {
    components:{
        Header,
        ShowPost
    },
    mounted(){
     this.getUser(),
     this.getPost()
    },
    data(){
        return{
            data:{
                name:'',
                email:'',
                post:''
               
            },  
        }
    },
    methods:{
        getUser: function(){
            axios.get('/data/accounts/user').then(response => {
                this.user = response.data.user
                this.data.name = this.user.name
                this.data.email = this.user.email
                this.data.role = this.user.role
                })
        },
         storePost: function() {
                axios.post('/users/post',{
                    name:this.data.name,
                    email:this.data.email,
                    post:this.data.post,
                }).then(response => {
               console.log('Done by '+this.data.name)
                })
            }
    }
}
</script>
<style>
#PostingSide{
 background-color:#f2f2f2;
 box-shadow:0px 0px 5px grey;
}
#PostingField{
border: none;
border-radius:10px;
box-shadow: 0px 4px 5px grey;
}
</style>