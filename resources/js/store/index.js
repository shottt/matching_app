import Vue from 'vue';
import Vuex from 'vuex';
import auth_displaying from "./modules/auth_display";

 
Vue.use(Vuex);
 
const store = new Vuex.Store({

  modules: {
    auth_displaying
  }
});

export default store;