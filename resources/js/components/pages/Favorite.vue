<template>
    <div class="Favorite">
        <Header/>
        <section id="favorite-top">
            <div v-show="authToken">
                <h1>My<br/>Favorite</h1>
            </div>
            <div v-show="!authToken">
                <h1>Public<br/>Favorite</h1>
            </div>
          
        </section>
        <div v-show="error&&dataExists" >
            <div id="msg">{{error}}</div>
        </div>
        <div class="load">
           <loader v-show="loading && !dataExists"/>
        </div>
        <div v-show="!loading">
            <section id="favorite-item">
                <ShowFavorite v-for=" item in FavoriteItems" :key="item.id" :item="item"/>
            </section>
            <paginate
            :page-count="getPageCount"
            :page-range="10"
            :margin-pages="2"
            :click-handler="clickCallback"
            :prev-text="'&laquo'"
            :next-text="'&raquo'"
            :page-link-class="'page-link'"
            :prev-class="'page-item'"
            :prev-link-class="'page-link'"
            :next-class="'page-item'"
            :next-link-class="'page-link'"
            :container-class="'pagination'"
            :page-class="'page-item'"/>
        </div>
    </div>
</template>

<script>


import Header from '../UI/Header.vue'
import ShowFavorite from '../view/ShowFavorite'
import Loader from '../UI/loader.vue'

export default {
  components: {  Header, ShowFavorite, Loader },
  name:'favorite',
  data(){
  return{
    data:[],
    perPage:6,
    dataExists:false,
    error:'',
    authToken:"",
    loading:true,
  }
  },
  created(){
     this.$store.dispatch('getSessionToken')
  },
  mounted:function(){
      this.getFavoriteData();
      this.$store.dispatch('getCurrentPage', 1)
  },
  computed:{
    FavoriteItems : function () {
      return this.data.slice((this.$store.getters.getPage -1) * this.perPage, this.$store.getters.getPage * this.perPage)
    
    },
    getPageCount : function(){
      return Math.ceil(this.data.length / this.perPage)
    },
  },
  methods:{ 
    
    getFavoriteData:function(){ 
      const user_id = this.$store.getters.getUserId;
      let endpoint = ''

      this.$store.getters.getToken ? 
      endpoint = this.endpoint()+`/${user_id}` :
      endpoint = this.endpoint()

      this.$http.get(endpoint)
      .then(response=>{
        if(!response.data.length){
          this.dataExists = true
          this.error = 'お気に入りはありません'
        }else{
          this.data = response.data;
          this.loading = false
        }
        
      })
        
    },
    clickCallback:function(pageNum){
      this.$store.dispatch('getCurrentPage', pageNum);
      scroll({
        top : 570,
        behavior: "smooth"
      })
    }
  }

}
</script>

<style>

*{
    margin: 0;
    padding: 0; 
}

.favorite{
   margin: 0 auto;
   width: 1000px;
}
#favorite-top{
  height: 500px;
  background: url(../../../../public/image/mainImg/favorite2.jpg);
  background-attachment: fixed;
  background-repeat: no-repeat;
  background-position: center center;
  background-size: cover;
  width: 100%;
}
#favorite-item{
    margin: 0 auto;
     display: flex;
    flex-wrap: wrap;
    justify-content: center;
}
#msg{
  margin: 0 auto;
  color:#fff;
  font-size: 23px;
  font-weight: bold;
  margin-top: 30px;
}
.load{
    height: 57px;
}

</style>