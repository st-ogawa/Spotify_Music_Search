const getDefaultState =()=> {
  return {
    userName:''
  }
}

const state = getDefaultState
  

const getters = {
  getUserName:state =>{
    return  state.userName 
  }
}
const actions = {
  getLoginUserName:({commit},userName) => {
    commit('setLoginUserName',userName)
  },
  getSessionUserName :({commit}) => {
      commit('setSessionUserName')
  },
  refreshStateUserName:({commit}) => {
      commit('refreshUserName')
  }
}
const mutations = {
   setLoginUserName : (state,userName) => {
    sessionStorage.setItem('user',userName)
     state.userName = userName
   },
   setSessionUserName : state => {
     state.userName = sessionStorage.getItem('user')
   },
   refreshUserName : state  => {
     state.userName = Object.assign(state,getDefaultState())
     
   }
}
    
export default{
    state,
    actions,
    getters,
    mutations
}
