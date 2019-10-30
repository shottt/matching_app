//import Vuex from "vuex";
//import createPersistedState from "vuex-persistedstate";


const state = () => ({
  pattern: "top"
})

const actions = {
  pattern_top: function (context) {
      context.commit('change', "top");
  },
  pattern_home: function (context) {

      context.commit('change', "home")
  },
  pattern_search: function (context) {
      context.commit('change', "search")
  },
}

const mutations = {
  change: function (state, pattern_name) {

      state.pattern = pattern_name;
  },   
}


const getters = {
  getPattern_Vuex:  state => {
      return state.pattern;
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