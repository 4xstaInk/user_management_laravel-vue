<template>
    <div>
    <h1 v-if="listOfPosts !== null ">Posts are Available</h1>
    <h1 v-if="listOfPosts == null ">Posts are not Available</h1>
    <table class="table table-bordered table-hover">
    <thead>
    <tr>
<th>Posted By:</th>
<th>Email</th>
<th>Posts</th>
</tr>
    </thead>
    <tbody v-if="listOfPosts !== null">
<tr v-for="posts in listOfPosts">
<td>{{ posts.name}}</td>
<td>{{ posts.email}}</td>
<td>{{ posts.post}}</td>
</tr>
    </tbody>
    </table>
    </div>
</template>
<script>
export default {
       mounted(){
        this.getPost()
     
    },
    props:['user'],
    data(){
        return{
            listOfPosts:null
        }
    },
    methods:{
        getPost: function(){
            axios.get('/users/post/list', {params: this.params}).then(response => {
                this.listOfPosts = response.data.listOfPosts
                console.log(this.listOfPosts)
                })
        }
    } 
}

</script>