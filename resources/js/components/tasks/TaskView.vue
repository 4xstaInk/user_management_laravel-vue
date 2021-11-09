<template>
    
    <div class="card mt-3">
<div class="card-body">
<br>
<table class="table table-hover">
<thead>
<tr>
<th>number</th>
<th>Task</th>

<th>Action</th>
</tr>
</thead>
<tbody>
<tr>
<td>{{}}</td>
<td>{{}}</td>

<td>
<div class="btn-group">
<button class="btn btn-sm btn-success">
<i class="fas fa-check"></i>
</button>
</div>
</td>

</tr>
</tbody>
</table>
<paginatorDetai
</div>
</div>
</div>
</template>


<script>

export default {
   data(){
       results:null
   },
    mounted() {
            this.getUsers()
    },
   methods:{
        getUsers(){
                axios.get('users/items').then(response=>{
                    this.results = response.data.results
                })
            }
   }
}
</script>