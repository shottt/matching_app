//import Vuex from "vuex";
//import createPersistedState from "vuex-persistedstate";


const state = () => ({
  //ユーザー一覧
  friends: {},
  //ユーザー詳細
  user: {}
})

const actions = {

  friends: function (context, friend_objs) {
    context.commit('friends', friend_objs)
  },

  user: function (context, user_obj) {
    context.commit('user', user_obj)
  }
}


const mutations = {

  friends: function (state, friend_objs) {
    state.friends = friend_objs;
  },
  user: function (state, user_obj) {
    state.user = user_obj;
  },
}

const getters = {

  getFriends_Vuex:  state => {
    return state.friends;
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