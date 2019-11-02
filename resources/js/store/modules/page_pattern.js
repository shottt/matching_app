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
  pattern_search_result: function (context) {
    context.commit('change', "search_result")
  },
  pattern_settings: function (context) {
    context.commit('change', "settings")
  },

  //settings page
  pattern_my_Prof: function (context) {
    context.commit('change', "my_Prof")
  },
  pattern_set_Prof: function (context) {
    context.commit('change', "set_Prof")
  },
  pattern_set_Pass: function (context) {
    context.commit('change', "set_Pass")
  },
  pattern_set_Sign_out: function (context) {
    context.commit('change', "set_Sign_out")
  },
  pattern_set_Unsub: function (context) {
    context.commit('change', "set_Unsub")
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