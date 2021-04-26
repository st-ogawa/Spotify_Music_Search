<template>
  <div class="ShowFavorite">
    <div class="contents">
        <img :src="item.jacket">
        <div class="favorite-detail" align="midlde">
          song : {{item.song}} <br/>
          album : {{item.album}} <br/>
          artist : {{item.artist}}
        </div>
        <div v-show="inActive">
          <div class="like-icon" @click="remove" :class="{heart:inActive}">
            <FavoriteButton/>
          </div>
        </div>
        <div v-show="!inActive">
          <div class="like-icon" @click="add" :class="{heart:inActive}">
            <FavoriteButton/>
          </div>
        </div>
        <div v-show="popUp" id="pop-up-container">
          <div id="pop-up">{{message}}</div>
        </div>
        <a :href="item.spotify_url" id="Detailed-link">詳細</a>
    </div>
  </div>
</template>

<script>

import FavoriteButton from '../UI/FavoriteButton'
import axios from 'axios'
import Setting from '../../setting/setting'

export default {
  components: { FavoriteButton },
  props:[
    'item'
  ],

  data(){
    return{
      inActive : true,
      popUp : false,
      message : '',
    }
  },
  
  methods:{
    endpoint: function (){

      this.$store.getters.getToken ? 
      axios.defaults.headers.common['Authorization'] = "Bearer " + this.$store.getters.getToken 
      : axios.defaults.headers.common['Authorization'] = "Bearer " + Setting.LARAVEL_TOKEN;

      if(this.$store.getters.getToken){
        return `http://127.0.0.1:8000/api/favorite`
        
      } 
      else{
        return `http://127.0.0.1:8000/api/public`
      }
    },
    
    remove:function(){
      const id = this.item.id
      axios.delete(this.endpoint()+`/${id}`)
      this.inActive  = false
      this.popUp = true
      this.message = "お気に入りから削除しました"
      this.clearMessage();
    },
    add:function(){

      axios.post(this.endpoint(),
      {"song" : this.item.song, 
      "album" : this.item.album, 
      "artist" : this.item.artist, 
      "jacket" : this.item.jacket, 
      "spotify_id" : this.item.spotify_id, 
      "spotify_url": this.item.spotify_url})
      this.inActive = !this.inActive
      this.popUp = true
      this.message = "お気に入りに追加しました"
      this.clearMessage();
    },
    clearMessage:function(){
      setTimeout(()=>{this.popUp = false},2000)
    }
  },
 
}
</script>

<style>

.ShowFavorite{
  text-align: center;
  height: 70vh;
  margin-right: 30px;
}
.contents{
  width: 600px;
  color: #fff;
  padding: 10px;
  display: flex;
  justify-content: space-around;
  margin: 90px 0 50px 18px ;
}

.contents > img{
  width: 240px;
  height: 240px;
  margin-right: 40px;
  border-radius: 50px;
}

.favorite-detail{
  word-break:break-all;
  width: 200px;
  height: 240px;
  line-height:2.3;
  text-align: left;
  display: flex;
  align-items: center;
  margin-left: 40px;
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
  margin-top:220px;
  cursor: pointer;
}

.heartIcon{
  font-size: 20px;
}

.like-icon.heart{
  animation: heartAnimation .2s;
  color: rgba(247, 70, 70, 0.919); 
}

#pop-up{
  width:250px;
	margin:5em auto 0;
	padding:10px 20px;
  background-color:#1ED760;
  color: #fff;
  border-radius: 20px;
 
}

#pop-up-container{
  left: 50%;
  right: 50%;
  margin-left: -275px;
  margin-right:25.5px;
  margin-top: 125px;
  text-align: center;
  user-select: none;
}

#Detailed-link{
  margin-top: 216px;
  margin-left: 10px;
  width: 55px;
  height: 25px;
  font-size: 15px;
  cursor: pointer;
  text-align: center;
  border:1px solid #1ED760;
  border-radius: 20px;
  color:#fff;
  padding: 1px;
}
</style>