//import Vuex from "vuex";
//import createPersistedState from "vuex-persistedstate";


const state = () => ({
    disiplay: 1,
    user_id: 0
})

const actions = {
    sign: function (context) {
        context.commit('change', 1);
    },
    register: function (context) {

        context.commit('change', 2);
    },
    repass: function (context) {
        context.commit('change', 3);
    },

    set_user_id: function (context, value) {
        console.log(value);
        context.commit('set_user_id', value);
    }
}


const mutations = {

    change: function (state, flg) {

        state.disiplay = flg;
    },

    set_user_id: function (state, value) {
        state.user_id = value;
    }
    
}

const getters = {
    getDisplay_Vuex:  state => {
        return state.disiplay;
    },

    getUser_Id_Vuex:  state => {
        return state.user_id;
    },    
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