<template>
    <div class="header">
        <div class="header-navi">
            <div class="logo-container">
                <a href="https://st-ogawa9632.site"><img alt="logo" src="../../../../public/image/logo/Spotify.png" class="header-logo"></a>
            </div>
            <nav>
                <ul>
                    <li><router-link to="/">Home</router-link></li>
                   
                    <div v-if="$store.getters.getToken" id="route-logout">
                        <li><router-link to="/favorite">My Favorite</router-link></li>
                        <li class="dropdown">
                            <div class="text-ellipsis">
                                <div class="nav-link" @click="dropdown">{{$store.getters.getUserName}}</div>
                            </div>
                            <transition name="nav">
                                <nav class="user-related" v-show="isActive">
                                    <ul v-show="isActive" id="dropdown-menu">
                                    <li @click="logout" class="logout">Logout</li>
                                    </ul>
                                </nav>
                            </transition>
                            <i class="fas fa-caret-down"  @click="dropdown"></i>
                        </li>
                    </div>
                    <div v-else id="route-login">
                        <li><router-link to="/favorite">Public<br/>Favorite</router-link></li>
                        <li><router-link to="/auth/register">Register</router-link></li>
                        <li><router-link to="/auth/login">Login</router-link></li> 
                    </div>
                </ul>
            </nav>
            <div v-show="modal">
                <modal v-show="modal" @close="modal = !modal">
                    <h3 slot="body">ログアウトしました</h3>
                </modal>
            </div>
        </div>
    </div>
</template>

<script>

import Modal from './Modal';

export default {
  components:{ Modal },
  created(){
    this.$store.dispatch('getSessionToken')
    if(this.$store.getters.getToken){
       this.$store.dispatch('getSessionUser')
    }
  },
  
  data(){
    return{
      isActive:false,
      userName:'',
      modal:false
    }
  },
  methods:{
    logout:function(){
        this.modal = true
        this.$store.dispatch('refreshStateToken')
        this.$store.dispatch('refreshStateUser')
        window.scroll({top:0,behavior : "smooth"})
        setTimeout(()=>{this.$router.push('/').catch(err => {})},1500)
    },
    dropdown(){
        this.isActive = !this.isActive
    }
  }
}
</script>

<style>
ul{
    padding: 0;
}

.header-navi{
    height:60px;
    align-items: center;
    background: #fff;
    position: fixed;
    width: 100%;
    top: 0;
    z-index: 100;
    
}

nav{
    margin-left: auto;
    height: 60px;
}

nav ul{
    list-style: none;
    display: flex;
    padding-right: 20px;
    justify-content: flex-end;
    vertical-align: middle;
    padding-top: 10px;
    text-align: center;
    height: 100%;
}

nav li{
    padding:10px;
    font-weight: bold;
    font-family: 'Arial Narrow Bold', sans-serif;
    cursor: pointer;  
}

nav li a {
    margin-right: 10px;
    text-decoration: none;
    color:#030E12;
   
}

.logo-container{
    margin-left: 30px;
    float: left;
}

.header-logo{
    width:200px;
    height: 60px;
}
#route-logout{
    height: 45px;
    display: flex;
    align-items: center;
    user-select: none;
    
}
#route-login{
    height: 45px;
    display: flex;
    align-items: center;
    user-select: none; 
}
.logout{
    padding-left:20px;
}

.nav-link::before {
    position: absolute;
    top: 100%;
    left: 0;
    width: 100%;
    height: 30px;
   
}
.nav-link{
    overflow: hidden;
    text-overflow: ellipsis;
    width: 80px;
    margin-left: 10px;
}
.dropdown {
    width: 120px;
    position: relative;
    border: 2px solid  #030E12 ;
    border-radius: 10px;
    padding: 5px;
    display: flex;
    flex: 1;
}
.user-related{
    position: absolute;
    top: 100%;
    left: 100%;
    z-index: 100;
    width: 110px;
    height: 40px;
    margin-left: -112px;
    background: #fff;
    border-radius: 2px;
    line-height: 1.46667;
    margin-top: 5px;
    overflow: hidden;
}

.fa-caret-down{
    margin-top: 5px;
    margin-right: 5px;
}
.logout{
    padding: 0;
}
#dropdown-menu{
    padding: 9px;
    justify-content: center;
}
.nav-enter,
.nav-leave-to{
   height: 0;
}
.nav-enter-active,
.navleave-active{
    transition: all .3s;
}
</style>