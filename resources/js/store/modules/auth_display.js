//import Vuex from "vuex";
//import createPersistedState from "vuex-persistedstate";


const state = () => ({
    disiplay: 1
})

const mutations = {
    change: function (state, flg) {

        state.disiplay = flg;
    },   
}
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

const getters = {
    getDisplay_Vuex:  state => {
        return state.disiplay;
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