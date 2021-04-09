

const state = {

  currentPage:'',

}
const getters = {
  getPage:state =>{
    return state.currentPage
  }
}
const actions = {
  getCurrentPage:({commit}, currentPage) => {
    commit('setCurrentPage', currentPage)
  },
  
  
}
const mutations = {
  setCurrentPage:(state, currentPage) => {
    state.currentPage = currentPage
  },
  resetCurrentPage:()=>{
    state.currentPage = 1;
  }
}


export default {
  state,
  actions,
  mutations,
  getters
}
