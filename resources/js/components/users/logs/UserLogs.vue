<template>
    <div>
    <div class="card mt-3">
    <div class="card-body">
    <h1 class="text-center"><i class="fas fa-list-alt"></i> User Logs</h1>
    <h3><button class="btn btnn-sm btn-outline-primary mr-3" @click="$emit('view-dashboard')"><i class="fas fa-chevron-left"></i> Back</button></h3>
    <hr>
    <h3><small class="text-muted"><i class="fas fa-user"></i> {{user.name}}</small></h3>

    <Paginator v-if="results !== null" v-bind:results="results" v-on:get-page="getPage">
    </Paginator>

    <PaginatorDetails v-if="results !== null" v-bind:results="results">
    </PaginatorDetails>

    <table class="table table-bordered table-hover">
    <thead class="table-secondary">
    <tr>
    <th>Log Type</th>
    <th>Message</th>
    <th>Created</th>
    </tr>
    </thead>
    <tbody v-if="results !== null">
    <tr v-for="log in results.data">
    <td>{{log.slug}}</td>
    <td>{{log.message}}</td>
    <td>{{log.pretty_date}}</td>
    </tr>
    </tbody>
    </table>

    <PaginatorDetails v-if="results !== null" v-bind:results="results"></PaginatorDetails>
    <Paginator v-if="results !== null" v-bind:results="results"></Paginator>
    
    </div>    
    </div>
    </div>
</template>

<script>
import Paginator from '../../utilities/pagination/paginator.vue'
import PaginatorDetails from '../../utilities/pagination/paginatorDetails.vue'

export default {
  components: { 
      Paginator,
      PaginatorDetails
      },
    mounted(){
        this.getLogs()
    },
    props:['user'],
    data(){
        return{
            results: null,
            params:{
                page:1
            }
        }
    },
    methods:{
        getLogs: function(){
            axios.get('/data/users/logs/' + this.user.id, {params: this.params}).then(response => {this.results = response.data.results
            })
        },
        getPage: function(){
            this.params.page = event
            this.getLogs()
        }
    }
}
</script>