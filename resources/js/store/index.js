import Vue from 'vue';
import Vuex from 'vuex';
import auth_displaying from "./modules/auth_display";
import page_displaying from "./modules/page_pattern";
import user_info from "./modules/user_info";

Vue.use(Vuex);
 
const store = new Vuex.Store({

  modules: {
    auth_displaying,
    page_displaying,
    user_info,
  }
});

export default store;