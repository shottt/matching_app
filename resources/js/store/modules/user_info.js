//import Vuex from "vuex";
//import createPersistedState from "vuex-persistedstate";


const state = () => ({
  frends: {}
})

const actions = {

  frends: function (context, frend_objs) {
    context.commit('frends', frend_objs)
  }
}


const mutations = {

  frends: function (state, frend_objs) {
    state.frends = frend_objs;
  },
}

const getters = {


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