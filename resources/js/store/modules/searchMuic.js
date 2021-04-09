

const state ={
  items:[],
}
const getters = {
  getItems:state=>{
    return state.items;
  },
}
const  actions = {

  getSearchItems:({commit},searchItems) => {
    commit('setSearchItems', searchItems);
  },

  getisFavorite:({commit},deleteId) => {
    commit('setisFavorite', deleteId)
  },

  getId:({commit},deleteId, spotifyId) => {
    commit('setId',{deleteId, spotifyId});
  },
  
}
const mutations ={

  setSearchItems:(state,items)=>{
    state.items =  items;
  },
 
  setisFavorite:(state, deleteId) => {
    Object.keys(state.items).map(keys => {
      state.items[keys].deleteId == deleteId ? 
      state.items[keys].isFavorite = !state.items[keys].isFavorite : null
      
    })
  },

  setId:(state,{deleteId,spotifyId}) => {

   let delId = Object.values(deleteId,spotifyId)[0];
   let spoId = Object.values(deleteId,spotifyId)[1];
    Object.keys(state.items).map(keys =>{

      if(state.items[keys].spotifyId == spoId){
        state.items[keys].deleteId = delId 
        state.items[keys].isFavorite = !state.items[keys].isFavorite
      }
      else{
        null
      }
    })
  },
}

export default {
  state,
  actions,
  mutations,
  getters
}
  