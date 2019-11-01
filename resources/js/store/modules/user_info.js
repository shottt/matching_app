//import Vuex from "vuex";
//import createPersistedState from "vuex-persistedstate";


const state = () => ({
  user_id: 0
})

const actions = {
  sign: function (context) {
      context.commit('change', 1)
  },
  register: function (context) {

      context.commit('change', 2)
  },
  repass: function (context) {
      context.commit('change', 3)
  },
}


const mutations = {
  change: function (state, id) {

      state.user_id = id;
  },   
}

const getters = {
  getUser_id:  state => {
      return state.user_id;
  }
}

export default {
  namespaced: true,
  state,
  mutations,
  actions,
  getters
}
/*
export const plugins = [
  createPersistedState(),
]*/