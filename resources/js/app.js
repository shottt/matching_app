/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
window.Vue = require('vue');

import store from "./store";
import router from './router/router';
import VueRouter from "vue-router";

require('./bootstrap');

//ui


/*
import VeeValidateJaLocale from 'vee-validate/dist/locale/ja'


import { ValidationProvider, extend } from 'vee-validate';

import { required } from 'vee-validate/dist/rules';

extend('required', {
  ...required,
  message: 'The {_field_} field is required'
});

Vue.use(VeeValidate, { locale: 'ja' });
*/

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));




//Vue.component('sign-register', require('./components/sign-register.vue').default);
//Vue.component('button-sign-register', require('./components/button-sign-register.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.mixin({
  data: function(){ return {
    vali_error: {
      
      required : "入力必須項目です。",//required attr
      min8: "8文字以上の文字を入力してください。",//minlength attr
      email: "メール形式で入力してください。",//email attr
      full_letters: "全角で入力してください。",
      half_letters: "半角で入力してください。",
      space: "空白は含めずに入力してください。",
      f_type: "正しいファイルを選択してください。",
      f_size: "ファイルサイズがオーバーしています。",
      //ハッキング対策
      null_byte: "不正な文字が検出されました。",
      xss: "不正なスクリプトが検出されました。",
      regexp_email: new RegExp("^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$"),
      regexp_half: new RegExp("^[a-zA-Z0-9]+$")
    }
  }},

  methods: {
    vali_required: function (type, value) {

      if (value == "") {
        this.errors[type] = this.vali_error.required;
        return false;

      } else {
        delete this.errors[type];
        return true;
      }
    },
    vali_email: function(type,value) {

      //メール形式判定
      var result = value.match(this.vali_error.regexp_email);
      if (result == null) {
        this.errors[type] = this.vali_error.email;
        return false;

      } else {
        delete this.errors[type];
        return true;
      }
    },

    vali_half: function(type,value) {

      var result = value.match(this.vali_error.regexp_half);
      if (result == null) {
        this.errors[type] = this.vali_error.half_letters;
        return false;

      } else {
        delete this.errors[type];
        return true;
      }
    },

  }
});

const vue_body = new Vue({
    el: '#vue_body',
    store,
    router,
    //mixins: [validation],
    //extends: validation,
    components: {
      
    },
    
});//.$mount("#vue_body");
