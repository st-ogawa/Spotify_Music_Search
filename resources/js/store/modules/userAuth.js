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
  getSessionUser :({commit}) => {
      commit('setSessionUser')
  },
  refreshStateUser:({commit}) => {
      commit('refreshUser')
  }
}
const mutations = {
   setLoginUser : (state,user) => {
      let users = {name: user.name, id: user.id,}
      sessionStorage.setItem('user',JSON.stringify(users))
      state.userName = user.name
      state.userId = user.id
   },
   setSessionUser : state => {
      let user = JSON.parse(sessionStorage.getItem('user'))
      state.userName = user.name;
      state.userId = user.id;
   },
   refreshUser : state  => {
     state.userName = Object.assign(state,getDefaultState())
   }
}
    
export default{
    state,
    actions,
    getters,
    mutations
}
