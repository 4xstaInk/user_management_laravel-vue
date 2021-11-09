<template>
<div>
<div>
<div style="height:100px;background-color:#d3fffe;">
<img src="./photos/banner.jpg" style="height:100px" alt="Banner" title="Banner" />
<img src="./photos/banner.jpg" style="height:100px;float:right;" alt="Banner" title="Banner" />
</div>

<Header class="Header"></Header>
    <div class="container m-3">
  <div class="jumbotron" style="height:2000px">
    <h1>Bootstrap Tutorial</h1>
    <p>Bootstrap is the most popular HTML, CSS, and JS framework for developing
    responsive, mobile-first projects on the web.</p>
    
  </div>
  <p>This is some text.</p>
  <p>This is another text.</p>
</div>
<Footer></Footer>
    </div>
    </div>
    
</template>

<script>
import Header from './homeComponents/header.vue';
import Footer from '../components/utilities/Footer/footer.vue';
export default {

    components:{
        Header,
        Footer
    },
    data(){
        return{
            data:{
                
            }
        }

    },
    methods:{
        
    }
}
</script>
<style>
.Header{
    position: sticky;
    top: 0;
     background-color:white;
  
}
</style>