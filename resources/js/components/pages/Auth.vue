<template>
  <div id="auth">
    <Header/>
    <section id="auth-top">
      <div id="auth-logo-container">
        <img src="../../../../public/image/logo/Spotify_Icon.png" id="auth-logo">
      </div>
      <h2>music search</h2>
      <router-view/>
    </section>
  </div>
</template>


<script>

import Header from '../UI/Header.vue'

export default {
  components: { Header, },

}
</script>

<style>
  #auth{
    background-image: url(../../../../public/image/mainImg/login.jpg);
    height: 100vh;
    width: 100vw;
  }
  #auth-top{
    padding-top: 90px;
    text-align: center;
    width: 100%;
    text-align: center;
    margin: 0;
  
  }
  #auth-logo-container{
    display: inline-block;
    width: 50px;
    width: 70px;
    height: 70px;
    background-color: #fff;
    border-radius: 50px;
   
  }
  #auth-logo{
    width: 60px;
    height: 60px;
     margin-top: 5px;
  }

</style>