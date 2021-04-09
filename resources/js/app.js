import Vue from 'vue'
import router from './router'
import store from './store/index'
import axios from 'axios'
import Paginate from 'vuejs-paginate'

require('./bootstrap');

window.Vue = require('vue');

Vue.component('paginate', Paginate)
Vue.component('app', require('./components/App.vue').default);

axios.defaults.headers.post['Content-Type'] = 'application/x-www-form-urlencoded';


const app = new Vue({
    el: '#app',
    router,
    store,
});
