import Vue from 'vue'
import router from './router'
import store from './store/index'
import axios from 'axios'
import Paginate from 'vuejs-paginate'
import Setting from './setting/setting'
import Mixin from './mixin/mixin'

require('./bootstrap');

window.Vue = require('vue');
Vue.mixin(Mixin);
Vue.component('paginate', Paginate)
Vue.component('app', require('./components/App.vue').default);


let token = ''

store.getters.getToken ? 
token = store.getters.getToken : token = Setting.LARAVEL_TOKEN;

console.log(process.env.MIX_BASE_URL)
Vue.prototype.$http = axios.create({
    headers:{'Authorization' : "Bearer " + token},
    baseURL: process.env.MIX_BASE_URL,
    timeout : 10000,
    responseType: 'json' 
}) 

const app = new Vue({
    el: '#app',
    router,
    store,
});
