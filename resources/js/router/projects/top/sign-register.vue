<script>
    import { mapGetters } from 'vuex';
    //import axios from 'axios';
    const usr = new URLSearchParams();
  
    export default {
      props: {
        test: String
      },
      data: function () {
        return {
          
          sign_email: "",
          sign_pass: "",
          name: "",
          location: "",
          email: "",
          pass: "",
          repass: "",
          regexp_email: new RegExp("^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$"),
          json_data: "",
          sign_errors: {},
          errors: {}
        }
      },
      computed: {
          ...mapGetters([
          'auth_displaying/getDisplay_Vuex',
          // ...
          ]),
          
          display_flg: function () {
            //後ほどpropsを変化させて、propsでbutton表示判定させたい
            return this.$store.getters['auth_displaying/getDisplay_Vuex'];
          },

          computed_erros: function () {
            return this.sign_errors;
          }
      },
      methods: {
        doSign_in: function () {
          console.log("button");
          //validation まだ画面にエラーメッセージだせてない
          this.null_check_Sign_Mail();
          this.null_check_Sign_Pass();

          if (Object.keys(this.sign_errors).length === 0) {
            
            //Post値　準備
            usr.append('email', this.sign_email);
            usr.append('pass', this.sign_pass);

            //CSRFトークン送信準備
            //let token = $('meta[name="csrf-token"]').attr('content');
            console.log(this.$http);

            //サインイン jsonで投げる ※bootsrap.jsで$httpにaxiosを代入してる
            this.$http.post('http://localhost:8000/api/ctrl_sign_in', {
                params: usr,
              })
              .then(res => {
                console.log("成功");
                this.json_data = res.data;
                this.$router.push({ path: 'home' })
              })
              .catch(err => console.log(err))
              .finally(() => {
                delete this.sign_errors.sign_email;
                delete this.sign_errors.sign_pass;
                console.log('finally')
              });

          } else {
            alert("予期せぬエラーが出ました。画面を更新してください");
          }
        },

        null_check_Sign_Mail: function () {
          //メール形式判定
          var result = this.sign_email.match(this.regexp_email);
          if (result == null) {
            this.sign_errors.sign_email = 'メール形式で入力してください。';
          } else {
            delete this.sign_errors.sign_email;
          }
        },
        null_check_Sign_Pass: function () {
          if (this.sign_pass === "") {
            this.sign_errors.sign_pass = 'パスワードを入力してください。';
          } else {
            delete this.sign_errors.sign_pass;
          }
        },

        error_Pass: function () {

          if (this.pass === this.repass) {

          }
          if (this.errors['pass']) {
            this.pass === this.repass ? "" : this.errors['pass']="一致してません";
          }
        },
      },
      tempalte: `
      <p>aaaa</p>  
      `
    }


</script>

<!--
  <div v-if="display_flg === 1">

    <h1>サインイン</h1>
    <img class="img-fluid u-mt-40" src="/images/man-1.png" alt="">
    <form action="" class="sign-Form mt-5">
      
      <input v-model="sign_email" class="u-bg-tr" type="email" name="email" id="" placeholder="メールアドレス">
      <input v-model="sign_pass" class="u-bg-tr mt-2" type="password" name="pass" id="" placeholder="パスワード">

      <button @click.prevent="doSign_in" type="button" class="btn btn-light w-100 u-text-pink mt-5">はじめる</button>
      
     
    </form>
    <p class="text-white">{{ $store.state.dispaly }}</p>
    <a class="mt-3 u-txt-w3 d-inline-block w-100 text-center">パスワード忘れましたか？</a>
  </div>
  <div v-else-if="display_flg === 2">
    <h1>新規登録</h1>
    <form action="" class="sign-Form mt-5 text-left">
      
      <label class="mt-2" for="name">氏名</label>
      <input v-model="name" class="u-bg-tr text-left pl-2" type="text" name="name" id="name" placeholder="苗字と名前を入力してください。">
      
      <label class="mt-2" for="location">住所</label>
      <input v-model="location" class="u-bg-tr text-left pl-2" type="text" name="location" id="location" placeholder="住所を入力してください。">
      
      <label class="mt-2" for="email">メールアドレス</label>
      <input v-model="email" class="u-bg-tr text-left pl-2" type="email" name="email" id="email" placeholder="メールアドレスを入力してください。">      
      
      <label class="mt-2" for="pass">パスワード</label>
      <input v-model="pass" class="u-bg-tr text-left pl-2" type="password" name="pass" id="pass" placeholder="パスワードを入力してください。">
      <input v-model="repass" class="u-bg-tr text-left pl-2" type="password" name="repass" id="repass" placeholder="再度パスワードを入力してください。">
 
      
      <button type="button" class="btn btn-light w-100 u-text-pink mt-5">新規登録</button>
    </form>
  </div>-->