import Vue from 'vue';
import VueRouter from 'vue-router';
import Home from './components/pages/Home'
import Favorite from './components/pages/Favorite'

Vue.use(VueRouter);

export default new VueRouter({
  mode : 'history',
  routes : [
    { path: '/', component: Home },
    { path: '/favorite', component:Favorite },
  ] 
})