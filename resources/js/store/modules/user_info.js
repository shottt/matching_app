//import Vuex from "vuex";
//import createPersistedState from "vuex-persistedstate";


const state = () => ({
  frends: {},
  user: {}
})

const actions = {

  frends: function (context, frend_objs) {
    context.commit('frends', frend_objs)
  },

  user: function (context, user_obj) {
    context.commit('user', user_obj)
  }
}


const mutations = {

  frends: function (state, frend_objs) {
    state.frends = frend_objs;
  },
  user: function (state, user_obj) {
    state.user = user_obj;
  },
}

const getters = {

  getFrends_Vuex:  state => {
    return state.frends;
  },

  getUser_Vuex:  state => {
    return state.user;
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