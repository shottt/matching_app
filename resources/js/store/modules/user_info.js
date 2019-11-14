//import Vuex from "vuex";
//import createPersistedState from "vuex-persistedstate";


const state = () => ({
  user_id: 0,
  frends: {}
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
  frends: function (context, frend_objs) {
    context.commit('frends', frend_objs)
  }
}


const mutations = {
  change: function (state, id) {

      state.user_id = id;
  },
  frends: function (state, frend_objs) {
    state.frends = frend_objs;
  },
}

const getters = {
  /*getUser_id:  state => {
      return state.user_id;
  },*/

  getFrends_Vuex:  state => {
    return state.frends;
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