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


/*よくわからんから、バリデーションは自作した
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
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */


import { mapGetters } from 'vuex';
import action_btn from './components/ui/button/action-button.vue';
import search_icon from './components/ui/icon/search_icon.vue';
import edit_icon from './components/ui/icon/edit_icon.vue';

const VueUploadComponent = require('vue-upload-component');
Vue.component('file-upload', VueUploadComponent);

Vue.mixin({
  data: function(){ return {
    pattern: "",
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
    },

  }},
  created: function () {

  },

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

    //ページごとの判定をするために、ページのパターンを設定する
    change_Page_Pattern: function (pattern) {
      this.pattern = this.$store.dispatch('page_displaying/set_Vuex__pattern', pattern);
    },

    //プロフィール更新系
    get_Prof_Type: function (obj, text) {
      switch (text) {
        case "name":
          if (obj.name_flg === false ) {
            obj.name_flg = true;
          } else {
            obj.name_flg = false;
          }
          break;
        case "occupation":
          if (obj.occupation_flg === false ) {
            obj.occupation_flg = true;
          } else {
            obj.occupation_flg = false;
          }
          break;
        case "location":
          if (obj.location_flg === false ) {
            obj.location_flg = true;
          } else {
            obj.location_flg = false;
          }
          break;
        case "profile_header":
          if (obj.profile_header_flg === false ) {
            obj.profile_header_flg = true;
          } else {
            obj.profile_header_flg = false;
          }
          break;
        case "profile_detail":
          if (obj.profile_detail_flg === false ) {
            obj.profile_detail_flg = true;
          } else {
            obj.profile_detail_flg = false;
          }  
          break;
        case "picture":
          if (obj.picture_flg === false ) {
            obj.picture_flg = true;
          } else {
            obj.picture_flg = false;
          }  
          break;
        default:
          break;
      };
    },
    get_Post_Value_Type: function (obj, text) {
      let my_data = {};
      switch (text) {
        case "name":
          my_data['name'] = obj.name;
          return my_data;
        case "occupation":
          my_data['occupation'] = obj.occupation;
          return my_data;
        case "location":
          my_data['location'] = obj.location;
          return my_data;
        case "profile_header":
          my_data['profile_header'] = obj.profile_header;
          return my_data;
        case "profile_detail":
          my_data['profile_detail'] = obj.profile_detail;
          return my_data;
        case "picture":
          my_data['picture'] = obj.picture;
          return my_data;
        default:
      };

    },
    update_Prof: function (obj, text) {
      let my_data = this.get_Post_Value_Type(obj, text);
      console.log(my_data);
      if (my_data === null ) {
        alert("編集に失敗しました。");
        return;
      }
      obj.$http.post('/api/ctrl_set_prof', {
        "my_data": my_data,
      })
      .then(res => {
        if (res.data.result_flag === false) {
          alert("通信成功しましたが、該当データ見当たらないです。");
          return;
        }
        console.log("プロフィール更新成功");
        obj.json_data = res.data;
        console.log(obj.json_data);
        
        //window.laravel 更新
        window.Laravel.my_data['id'] = obj.json_data.my_data['id'];
        window.Laravel.my_data['name'] = obj.json_data.my_data['name'];
        window.Laravel.my_data['email'] = obj.json_data.my_data['email'];
        window.Laravel.my_data['occupation'] = obj.json_data.my_data['occupation'];
        window.Laravel.my_data['location'] = obj.json_data.my_data['location'];
        window.Laravel.my_data['profile_header'] = obj.json_data.my_data['profile_header'];
        window.Laravel.my_data['profile_detail'] = obj.json_data.my_data['profile_detail'];
        window.Laravel.my_data['birthday'] = obj.json_data.my_data['birthday'];
        window.Laravel.my_data['picture'] = 'data:text/html; charset=UTF-8;base64,' + obj.json_data.my_data['picture'];

        //vuex 更新
        obj.$store.dispatch('auth_displaying/set_my_data', window.Laravel.my_data);

        //表示内容更新
        obj.name__displayed = obj.json_data.my_data['name'];
        obj.email__displayed = obj.json_data.my_data['email'];
        obj.occupation__displayed = obj.json_data.my_data['occupation'];
        obj.location__displayed = obj.json_data.my_data['location'];
        obj.profile_header__displayed = obj.json_data.my_data['profile_header'];
        obj.profile_detail__displayed = obj.json_data.my_data['profile_detail'];
        obj.birthday__displayed = obj.json_data.my_data['birthday'];
        obj.picture__displayed = 'data:text/html; charset=UTF-8;base64,' + obj.json_data.my_data['picture'];


        // obj.name__displayed = "";
        // obj.email = "";
        // obj.occupation = "";
        // obj.location = "";
        // obj.profile_header = "";
        // obj.profile_detail = "";
        // obj.birthday = "";
        // obj.picture = "";

        this.get_Prof_Type(obj, text);
        
        return obj.json_data;
      }).catch(err => console.log(err)
      
      ).finally(() => {
          console.log('finally');
      });
    },
    
  },
  
  computed: {
    ...mapGetters([
    'auth_displaying/getDisplay_Vuex',
    //'auth_displaying/getUser_Id_Vuex',
    'auth_displaying/getMy_Data_Vuex',
    'page_displaying/getPattern_Vuex',
    'user_info/getFriends_Vuex',
    'user_info/getUser_Vuex',
    ]),
  },
  components: {
    action_btn,search_icon,edit_icon,
  },
  
});

const vue_body = new Vue({
    el: '#vue_body',
    store,
    router,
    //mixins: [validation],
    //extends: validation,

    
}).$mount("#vue_body");
