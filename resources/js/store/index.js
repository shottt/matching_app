import Vue from 'vue';
import Vuex from 'vuex';
import auth_displaying from "./modules/auth_display";
import page_displaying from "./modules/page_pattern";
 
Vue.use(Vuex);
 
const store = new Vuex.Store({

  modules: {
    auth_displaying,
    page_displaying
  }
});

export default store;