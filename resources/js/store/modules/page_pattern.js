//import Vuex from "vuex";
//import createPersistedState from "vuex-persistedstate";


const state = () => ({
  pattern: "top"
})

const actions = {

  set_Vuex__pattern: function (context, value) {
    context.commit('change', value);
  },
}

const mutations = {
  change: function (state, pattern_name) {
    console.log("sate: " );
    console.log(state);
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