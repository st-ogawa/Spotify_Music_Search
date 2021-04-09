<template>
  <div id="register">
    <section id="register-top">
        <p>Register</p>
    </section>
    <section id="register-container">
        <LoginForm placeholder="UserName" id="user-form" v-model="userName" :errmsg="userErrMsg"  @submitData="register"/><br/>
         <div v-show="userErrMsg.length>0" class="userError">
          {{userErrMsg}}
        </div>
        <LoginForm placeholder="Email" id="register-mail" v-model="registerMail" :errmsg="mailErrMsg"  @submitData="register"/><br/>
        <div v-show="mailErrMsg.length>0" class="mailError">
          {{mailErrMsg}}
        </div>
        <div class="password-form">
          <LoginForm :type="inputType" placeholder="Password" id="register-pass" v-model="registerPass" :errmsg="passErrMsg" @submitData="register"/>
          <div :class="iconType" @click="viewPassword"/>
        </div><br/>
        <div v-show="passErrMsg.length>0" class="passwordError">
          {{passErrMsg}}
        </div>
        <LoginButton value="Register"  @submitData="register"/> 
    </section>
    <div v-show="modal">
        <modal v-show="modal" @close="modal = !modal">
            <h3 slot="body" v-show="$store.getters.getToken">ユーザー登録しました</h3>
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
  components: { LoginForm, LoginButton,Modal, },
  data(){
    return{
      registerMail : '',
      registerPass : '',
      userName : '',
      isChecked:false ,
      userErrMsg:'',
      mailErrMsg:'',
      passErrMsg:'',
      modal:false
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
    register:function(){
      
      axios.post('http://192.168.1.29:8000/api/register',{
        'name': this.userName,
        'email' : this.registerMail,
        'password' : this.registerPass,
      })
      .then(res=>{
        this.modal = true
        const userName = res.data.data.user.name
        this.$store.dispatch('getLoginUserName',userName)
        this.$store.dispatch('getAuthToken', res.data.data.Token)
        setTimeout(()=>{this.$router.push('/')},1500)
      })
      .catch(error=>{
        
        const errmsg = error.response.data.error
        errmsg.name === undefined?
        this.userErrMsg = '':
        this.userErrMsg = errmsg.name[0]

        errmsg.email === undefined?
        this.mailErrMsg = '':
        this.mailErrMsg = errmsg.email[0]
        
        errmsg.password === undefined?
        this.passErrMsg = '':
        this.passErrMsg = errmsg.password[0]
      })
    },
    viewPassword(){
      this.isChecked = !this.isChecked
    }
  }
}
</script>

<style>
#register-top p{
    color: #fff;
    font-size: 30px; 
    font-family: 'Arial Narrow Bold', sans-serif;
    font-weight: bold;
}
#register-container{
    margin-top: 20px;
    height: 250px;
}
#user-form{
  background-image: url(../../assets/icon/user.png);
  background-repeat: no-repeat;
  background-size: 20px;
	background-position: left 10px bottom 5px ; 
}
#register-mail{
  background-image: url(../../assets/icon/mail.png);
  background-repeat: no-repeat;
  background-size: 20px;
	background-position: left 10px bottom 5px ; 
}
#register-pass{
  background-image: url(../../assets/icon/lock.png);
  background-repeat: no-repeat;
  background-size: 20px;
	background-position: left 10px bottom 5px;
  margin-left: -5px;
}
.unvisible{
  background: url(../../assets/icon/unvisible.png);
  background-repeat: no-repeat;
  background-size: 20px;
  height: 23px;
  width: 25px;
  margin-left: -40px;
}
.visible{
  background: url(../../assets/icon/visible.png);
  background-repeat: no-repeat;
  background-size: 20px;
  height: 23px;
  width: 25px;
  margin-left: -40px;
}

.password-form{
  display: flex;
  justify-content: center;
  align-items: center;
}
.userError{
  margin-top: -11px;
  margin-bottom: -12px;
  color: #FF0000;
  font-size: 15px;
  font-weight: bold;
}
.mailError{
  margin-top: -11px;
  margin-bottom: -12px;
  color: #FF0000;
  font-size: 15px;
  font-weight: bold;
}
.passwordError{
  margin-top: -30px;
  margin-bottom: 8px;
  color: #FF0000;
  font-size: 15px;
  font-weight: bold;
}

</style>