<template>
  <div class="ShowResult">
    <div class="container">
        <div class ="display">
          <div class="images">
              <img :src="item.jacket">
          </div>
          <div class="detail" align="midlde">
            song : {{item.song}} <br>
            album : {{item.album}}<br>
            artist : {{item.artist}} <br>
            リリース日 : {{item.releaseDate}}
          </div>
          <div v-show="!item.isFavorite">
            <div class="like-icon" @click="add" :class="{heart:item.isFavorite}" :disabled = "!item.isFavorite"><FavoriteButton/></div>
          </div>
          <div v-show="item.isFavorite">
            <div class="like-icon" @click="remove" :class="{heart:item.isFavorite}" :disabled = "item.isFavorite"><FavoriteButton/></div>
          </div>
          <div v-show="modal" id="pop-up-container">
            <div id="pop-up" >{{message}}</div>
          </div>
        </div>
    </div>
  </div>
</template>

<script>

import axios from 'axios'
import FavoriteButton from '../UI/FavoriteButton';
import Setting from '../../setting/setting'

export default {
  components: { FavoriteButton },

  name: 'ShowResult',
  props:[
    'item',
  ],

  data(){
    return{
      id:'',
      message:'',
      modal:false,
    }
    
  },

  methods:{
    add:function(){
      
      const song = this.item.song;
      const album = this.item.album;
      const jacket = this.item.jacket;
      const artist = this.item.artist;
      const spotifyId = this.item.spotifyId;
      const externalLink = this.item.externalLink

      let ENDPOINT;

      this.$store.getters.getToken ? 
      axios.defaults.headers.common['Authorization'] = "Bearer " + this.$store.getters.getToken 
      : axios.defaults.headers.common['Authorization'] = "Bearer " + Setting.LARAVEL_TOKEN;

      this.$store.getters.getToken ? ENDPOINT = "http://192.168.1.29:8000/api/favorite" : ENDPOINT = "http://192.168.1.29:8000/api/public"
  
      axios.post(ENDPOINT,
      {"song":song, 
      "album":album,
      "artist":artist,
      "jacket":jacket,
      "spotify_id":spotifyId,
      "spotify_url":externalLink,
      })
      .then(response=> {
        const deleteId = response.data.data.favorite_id
        this.$store.dispatch('getId', {deleteId,spotifyId});
        this.modal = true;
        this.clearMessage();
       
        this.message = "お気に入りに登録しました";
      })
      .catch(error=>{
        this.modal = true;
        this.clearMessage();
        
        this.message = error.response.data.data.message;
      })
    },
    
    remove:function(){
      const id = this.item.deleteId
      axios.delete(`http://192.168.1.29:8000/api/favorite/${id}`)
      this.$store.dispatch('getisFavorite', id);
      this.message = "お気に入りから削除しました";
      this.modal = true;
      this.clearMessage();
    },

    clearMessage:function(){
      setTimeout(() => {this.modal = false},2000);
    }
    
  }
}

</script>
<style scoped>
    

.container{
 height: 80vh;
 
}
img{
  border-radius: 50px;
  margin:50px;
  width: 250px;
  height: 250px;
}
.display{
  padding-top: 15vh;
  height: 65vh;
  display:flex;
  flex-direction: row;
  justify-content: center;
  margin-top: 50px;
   
 
}
.detail{
  display: grid;
  place-items: center;
  color:#fff;
  width: 25%;
  height: 40vh;
  text-align: left;
  line-height:3;
  margin:50px;
  user-select: none;
}

@keyframes heartAnimation {
  0% {
    transform: scale(0.5);
  }
  10% {
    transform: scale(1.0);
  }
  30% {
    transform: scale(1.2);
  }
  50% {
    transform: scale(1.5);
  }
  80% {
    transform: scale(1.8);
  }
  100% {
    transform: scale(1.0);
  }
}
.like-icon{
  text-align: center;
  margin-top:280px;
  cursor: pointer;
  color: #fff;
}

.like-icon.heart{
  animation: heartAnimation .2s;
  color: rgba(245, 56, 56, 0.919);
}
#pop-up{
  width:250px;
	margin:10em auto 0;
	padding:10px 20px;
  background-color:#1ED760;
  color: #fff;
  border-radius: 20px;
}

.times{
  font-size: 20px;
}
#pop-up-container{
  left: 50%;
  right: 50%;
  margin-left: -130px;
  margin-right: -120px;
  margin-top: 60px;
  text-align: center;
  user-select: none;

}


</style>