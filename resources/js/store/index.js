import Vue from'vue'
import Vuex from'vuex'
import page from './modules/page'
import searhMusic from './modules/searchMuic'
import authToken from './modules/authToken'
import userAuth from './modules/userAuth'

Vue.use(Vuex)

export default new Vuex.Store({
    modules:{
        page,
        searhMusic,
        authToken,
        userAuth,
    },
    strict:process.env.NODE_ENV !== 'production'
})