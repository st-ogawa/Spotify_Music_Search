const getDefaultState =()=> {
  return {
    userName:'',
    userId:''
  }
}

const state = getDefaultState
  

const getters = {
  getUserName:state =>{
    return  state.userName 
  },
  getUserId:state =>{
    return state.userId
  }
}
const actions = {
  getLoginUser:({commit},user) => {
    commit('setLoginUser',user)
  },
  getSessionUserName :({commit}) => {
      commit('setSessionUserName')
  },
  refreshStateUserName:({commit}) => {
      commit('refreshUserName')
  }
}
const mutations = {
   setLoginUser : (state,user) => {
    sessionStorage.setItem('user',user.name)
    state.userName = user.name
    state.userId = user.id
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
