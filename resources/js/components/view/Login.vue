<template>
  <div id="login">
      <section id="login-top">
          <p>Login</p>
      </section>
      <section id="login-container">
        <LoginForm placeholder="Email" id="login-mail" v-model="loginMail" :errmsg="errmsg" @submitData="login"/><br/>
        <div class="password-form">
          <LoginForm :type="inputType" placeholder="Password" id="login-pass" v-model="loginPass" :errmsg="errmsg" @submitData="login"/>
          <div :class="iconType" @click="viewPassword"/>
        </div><br/>
        <div v-show="errmsg" id="error">
          {{errmsg}}
        </div>
        <LoginButton value="Login" @submitData="login"/>
      </section>
      <div v-show="modal">
        <modal v-show="modal" @close="modal = !modal">
            <h3 slot="body" v-show="$store.getters.getToken">ログインしました</h3>
        </modal>
      </div>
  </div>
</template>

<script>

import LoginButton from '../UI/LoginButton.vue'
import LoginForm from '../UI/LoginForm.vue'
import axios from 'axios'
import Modal from '../UI/Modal.vue';

export default {
  components: {LoginForm, LoginButton,Modal},
  data(){
    return{
      loginMail : '',
      loginPass : '',
      isChecked : false,
      errmsg : '',
      modal:false,
    }
  },
 
  computed:{
    inputType(){
      return this.isChecked ? "text" : "password";
    },
    iconType(){
      return this.isChecked ? "visible" : "unvisible"
    }
  },
  methods:{
    login(){
      axios.post('http://192.168.1.29:8000/api/login',{
        'email' : this.loginMail,
        'password' : this.loginPass
      }).then(res=>{
        this.modal = true
        this.$store.dispatch('getAuthToken', res.data.data.Token)
        const userName = res.data.data.user.name
        this.$store.dispatch('getLoginUserName',userName)
        setTimeout(()=>{this.$router.push('/')},1500)
      })
      .catch(error=>{
        this.errmsg = error.response.data.error;
      })
    },
     viewPassword(){
      this.isChecked = !this.isChecked
    }
  }
}
</script>

<style>
#login{
  height: 100%;
}
#login-top p{
  color: #fff;
  font-size: 30px;
  font-family: 'Arial Narrow Bold', sans-serif;
  font-weight: bold;
}

#login-container{
  height: 200px;
  margin-top: 20px;
}

#login-mail{
  background-image: url(../../../../public/image/icon/mail.png);
  background-repeat: no-repeat;
  background-size: 20px;
	background-position: left 10px bottom 5px ; 
}

#login-pass{
  background-image: url(../../../../public/image/icon/lock.png);
  background-repeat: no-repeat;
  background-size: 20px;
	background-position: left 10px bottom 5px ; 
  margin-left: -5px;
  
}
#error{
color: #FF0000;
margin-top: -20px;
font-size: 15px;
font-weight: bold;

}
</style>