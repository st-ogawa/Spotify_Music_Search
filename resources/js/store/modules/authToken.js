const getDefaultState = ()=>{
  return {
    authToken : '', 
  }
}


const state = getDefaultState();

const getters = {
  getToken : state =>{
    return state.authToken;
  },
}

const actions = {
  getAuthToken : ({commit},authToken)=> {
    commit('setAuthToken', authToken);

  },
  refreshStateToken :({commit}) => {
    commit('refreshToken')
  },
  getSessionToken : ({commit})=>{
    commit('setSessionToken')
  },
  
}

const mutations = {
  setAuthToken : (state, authToken) => {
    sessionStorage.setItem('token',authToken)
    state.authToken = authToken
    
  },
  refreshToken :state => {
    sessionStorage.removeItem('token')
    Object.assign(state,getDefaultState())
  },
  setSessionToken : state =>{
    state.authToken =  sessionStorage.getItem('token')
  },
}


export default {
  state,
  actions,
  mutations,
  getters
}