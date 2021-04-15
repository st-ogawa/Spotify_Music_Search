import Vue from 'vue';
import VueRouter from 'vue-router';
import Home from './components/pages/Home';
import Favorite from './components/pages/Favorite';
import Auth from './components/pages/Auth';
import Login from './components/view/Login';
import Register from './components/view/Register';


Vue.use(VueRouter);

export default new VueRouter({
  mode : 'history',
  routes: [
    {
      path: '/',
      name: 'home',
      component: Home,
    },
    {
      path: '/favorite',
      name: 'favorite',
      component: Favorite,
    },
    {
      path: '/auth',
      component: Auth,
      children : [
        {
          path: 'register',
          name: 'register',
          component: Register,
        },
        {
          path: 'login',
          name: 'login',
          component: Login,
        },
      ]
    },
  ]
})