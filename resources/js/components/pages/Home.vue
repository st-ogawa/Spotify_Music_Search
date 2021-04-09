<template>
  <div class="home">
      <div class="main">
        <Header/>
          <section id="top">
            <h1>Music Search</h1>
            <div class="search-container">
              <a @keydown.enter="search" ><SearchForm placeholder="Search for Songs, album" :val="searchMusicName" @input="searchMusicName = $event" /></a>
              <a @click="search" id="btn"><SearchButton/></a>
            </div>
            <div v-show="error.length" id="pop-up-message">
                <p id="error-pop-up">{{error}}</p>
            </div>
            <div v-show="popUp" id="pop-up-message">
                  <div id="pop-up">Scroll Down ↓↓</div>
            </div>
          </section>
          <section id="contents">
            <div v-show="items.length>0">
              <Result/>
            </div>
          </section> 
      </div> 
  </div>
</template>

<script>
import axios from 'axios'
import Result from './Result.vue';
import SearchForm from '../UI/SearchForm.vue';
import Header from '../UI/Header.vue';
import SearchButton from '../UI/SearchButton.vue';
import Setting from '../../setting/setting'


export default {
  components: { 
    Result,
    SearchForm,
    Header,
    SearchButton,
    
  },
  music_data: [],
  data(){
    return{
      searchMusicName : '',
      accessToken : '',
      error : '',
      items : [],
      popUp : false,
      showModal: true,
    }
    
  },
  created:function(){
   this.getToken();
   this.$store.dispatch('getCurrentPage', 1)
   this.$store.dispatch('getSessionToken')
  },
  methods:{
    getToken:function(){
      const params = new URLSearchParams();
      params.append('grant_type', 'client_credentials');

      let AUTH = 'Basic ' + btoa(Setting.CLIENT_ID+':'+Setting.CLIENT_SECRET)

      let axiosConfig = {
        headers:{
          'Authorization': AUTH,
          'content-Type':'application/x-www-form-urlencoded',
        }
      }
      axios.post('https://accounts.spotify.com/api/token', params, axiosConfig)
      .then(response => {
        this.accessToken = response.data.access_token
      }).catch(error => {
        console.log(error)
      })
    },
    
    search:function(){
      axios.get("https://api.spotify.com/v1/search",{
        headers:{
          "Authorization": `Bearer ${this.accessToken}`
        },
        params:{
          "q": this.searchMusicName, "limit":"50", "type":"track", "market":"JP", "ofset":"0", 
        }
      }).then(response => {
        this.items = response.data.tracks.items
        let searchItems =[];
        Object.keys(this.items).map(keys=> searchItems.push({
          'song' : this.items[keys].name, 
          'album' : this.items[keys].album.name, 
          'artist' : this.items[keys].artists[0].name, 
          'jacket' : this.items[keys].album.images[1].url,
          'releaseDate' : this.items[keys].album.release_date,
          'spotifyId' : this.items[keys].id, 
          'externalLink' : this.items[keys].external_urls.spotify,
          'isFavorite' : false,
          'deleteId' : '',
        }))
           
          if(this.items.length === 0){
            this.error = '検索結果がありません';
          }
          else{
            this.error = ''
            this.popUp = true;
            this.clearMessage();
            this.$store.commit('resetCurrentPage')
            this.$store.dispatch('getSearchItems', searchItems)
            scroll({
              top : 570,
              behavior : "smooth"
            })
          }
      }).catch(error => {
        console.log(error)
        this.error = '検索ワードを入力してください'
      })
    },
    clearMessage:function(){
      setTimeout(()=>{this.popUp = false},1500)
    },
  }
  
}

</script>

<style>

* {
   box-sizing: border-box;
   outline: 0;
}
html{
  height: 100%;
  margin: 0 auto;
  background-color: #030E12;
}

body{
  margin:0;
  height: 100%;
}

#top {
  background-image:
  url("../../../../public/image/mainImg/main2.jpg");
  background-attachment: fixed;
  background-repeat: no-repeat;
  background-position: center center;
  min-height: 100vh;
  background-size: cover;
  width: 100%;
}

#contents{
  height: 100%;
  background-color: #030E12;
  width: 100%;
  position: relative;
}

h1 {
  margin:0px;
  padding-top: 200px;
  padding-bottom: 50px;
  font-size: 60px;
  font-family: 'Corben', cursive;
  color:#fff ;
  user-select: none;
  line-height: 80px;
  text-shadow:
    0 0 2px rgba(204,208, 212,0.9),
    0 15px 25px rgba(0, 0, 0, 0.3),
    0 -2px 3px rgba(0, 0, 0, 0.1),
    0 -5px 10px rgba(255, 255, 255, 0.028),
    0 5px 10px rgba(0, 0, 0, 0.3),
    0 3px 4px rgba(16, 17, 17, 0.2),
    0 0 20px rgba(10, 10, 10, 0.45);
}
h2{
  color: #fff;
    font-family: 'Corben', cursive;
  font-size: 45px;
}

a{
  text-decoration:none; 
}

.search-container{
  padding-top: 100px;
  position: relative;
  height: 50px
}

#pop-up-message{
  left: 50%;
  right: 50%;
  margin-top: -10px;
  text-align: center;
  user-select: none;
}
#error-pop-up{
  width:280px;
	margin:5em auto 0;
	padding:10px 20px;
  background-color:#1ED760;
  color: #fff;
  border-radius: 20px;
  height: 40px;
}

</style>