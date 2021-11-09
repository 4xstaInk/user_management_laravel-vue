<template>
<div>
<!--<img src="../photos/cover.png" style="height: 70vh; width:100%;" class="rounded" alt="Cinque Terre">-->

<div>

<h3 @click="showBar" class="menuopen"  v-if="data.bar.viewBar !== 'yes' " style="cursor:pointer;" ><i class="fas fa-square ml-5 mt-2" ></i> Menu</h3>

<h3 @click="closeBar" class="menuclose" v-if="data.bar.viewBar !== 'no' " style="cursor:pointer; color:#e69900" ><i class="fas fa-th ml-5 mt-2" style="cursor:pointer;"></i> Close Menu</h3> 

   <div v-if="data.bar.viewBar !== 'no' ">
      <div class="flex-container">
         <div><i class="fas fa-user"></i> Manage Users</div>
         <div><i class="fas fa-wrench"></i> Account Settings</div>
         <div><i class="fas fa-sign-out" ></i> LogOut</div>  
     </div>
   </div>
</div>
</div>
</template>

<script>

export default {

    data(){
        return{
            data:{
                bar:{
                    viewBar:'no'
                }
            }
        }

    },
    methods:{
        showBar: function(){
            this.data.bar.viewBar ='yes'
        },
        closeBar: function(){
            this.data.bar.viewBar ='no'
        }
    }
}
</script>

<style>
.menuopen{
   
    box-shadow: 0px 5px 10px#e6e6e6;
    position:sticky;
}
.flex-container {
  width:50%;
  display: flex;
  flex-direction: column;
  margin-left:50px;
  
}
.flex-container > div {
  background-color:none;
   
  margin: 10px;
  padding:10px;
  line-height: 75px;
  font-size:20px;
  cursor:pointer;
border-left: 6px solid #80bfff;
border-bottom: 3px solid #80bfff;
border-radius: 12px;
}
.flex-container > div:hover{
    background-color:#80bfff; 
border-left: 6px solid rgb(255, 113, 113);
border-bottom: 3px solid rgb(255, 113, 113);
border-radius: 12px;
}
.flex-container > h3{
  cursor:pointer; 
}

</style>