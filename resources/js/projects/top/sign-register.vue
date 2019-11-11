<script>
  //const usr = new URLSearchParams();

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
        //sign_errors: {},
        errors: {}
      }
    },

    computed: {
        //サインインか登録の描画判定のフラグです
        display_flg: function () {
          //後ほどpropsを変化させて、propsでbutton表示判定させたい
          return this.$store.getters['auth_displaying/getDisplay_Vuex'];
        },

    },
    methods: {
      doSign_in: function () {
        /*
        this.vali_required("sign_email", this.sign_email);
        this.vali_required("sign_pass", this.sign_pass);

        if (Object.keys(this.errors).length > 0) {
          return;
        }

        //メール形式
        this.vali_email("sign_email", this.sign_email);
        //半角判定
        
        this.vali_half('sign_pass', this.sign_pass);
        if (Object.keys(this.errors).length > 0) {
          return;
        }
        */
        if (Object.keys(this.errors).length === 0) {
                   
          //サインイン jsonで投げる ※bootsrap.jsで$httpにaxiosを代入してる
<<<<<<< HEAD
          this.$http.post('login', {
=======
          //this.$http.post('/api/ctrl_sign_in', {
          this.$http.post('/login', {
>>>>>>> 3d0e33c1f32cec41f57249873dcdb6c881976b59
              email: this.sign_email,
              password: this.sign_pass
            })
            .then(res => {
              console.log("サインイン成功");
              this.json_data = res.data;
              console.log("user_id : " + this.json_data.user_id);
              console.log("result_flag : " + this.json_data.result_flag);

              //ログイン結果判定
              if (this.json_data.user_id !== null && this.json_data.result_flag === true) {

                //user_id設定
                this.$store.dispatch('auth_displaying/set_user_id', this.json_data.user_id );

                //描画のための画面判定値を更新
                this.$store.dispatch('page_displaying/set_Vuex__pattern', "home");
                this.$router.push({ path: 'home' });

              } else {
                alert("ログイン失敗です。メールアドレスとパスワードを正しく入力してください。");
              }
            })
            .catch((err) => {
              console.log(err)
            })
            .finally(() => {
              console.log('finally')
            });

        } else {
        }
      },
      doRegisteration: function () {
        console.log("登録開始");

        //validation あとでやる
        //まだ画面にエラーメッセージもまだ

        if (Object.keys(this.errors).length === 0) {
          
          //Post値　準備
          /*
          usr.append('name', this.name);
          usr.append('location', this.location);
          usr.append('email', this.email);
          usr.append('pass', this.pass);*/


          //登録 jsonで投げる ※bootsrap.jsで$httpにaxiosを代入してる
          this.$http.post('/api/ctrl_registration', {
              name: this.name,
              location: this.location,
              email:this.email,
              pass:  this.pass
            })
            .then(res => {

              //成功
              console.log("登録成功");
              this.json_data = res.data;
              console.log(this.json_data);
              this.$router.push({ path: 'home' })

              //失敗 msg=>メールとパスが不一致です。
            })
            .catch(err => {
              console.log(err);
            })
            .finally(() => {
              //delete this.sign_errors.sign_email;
              //delete this.sign_errors.sign_pass;
              console.log('finally')
            });

        } else {
          alert(1111);
        }
      },

      null_check_Sign_Mail: function () {
        //メール形式判定
        var result = this.sign_email.match(this.regexp_email);
        if (result == null) {
          //this.sign_errors.sign_email = 'メール形式で入力してください。';
        } else {
          //delete this.sign_errors.sign_email;
        }
      },
      null_check_Sign_Pass: function () {
        if (this.sign_pass === "") {
          //this.sign_errors.sign_pass = 'パスワードを入力してください。';
        } else {
          //delete this.sign_errors.sign_pass;
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



    template: `
      <article>
        <section v-if="display_flg === 1">

          <h1>サインイン</h1>
          <img class="img-fluid u-mt-40" src="/images/man-1.png" alt="">
          <form class="sign-Form mt-5" >
            <input v-model="sign_email" class="u-bg-tr" type="email" name="email" id="" placeholder="メールアドレス" required>
            <input v-model="sign_pass" class="u-bg-tr mt-2" type="password" name="pass" id="" placeholder="パスワード" required minlength="8">

            <button @click.prevent="doSign_in" type="button" class="btn btn-light w-100 u-text-pink mt-5">はじめる</button>
            
          
          </form>
          <p class="text-white">{{ $store.state.dispaly }}</p>
          <a class="mt-3 u-txt-w3 d-inline-block w-100 text-center">パスワード忘れましたか？</a>
        </section>

        <section v-else-if="display_flg === 2">

          <h1>新規登録</h1>
          <form action="" class="sign-Form mt-5 text-left">
            
            <label class="mt-2" for="name">氏名</label>
            <input v-model="name" class="u-bg-tr text-left pl-2" type="text" name="name" id="name" placeholder="苗字と名前を入力してください。" required>
            
            <label class="mt-2" for="location">住所</label>
            <input v-model="location" class="u-bg-tr text-left pl-2" type="text" name="location" id="location" placeholder="住所を入力してください。" required>
            
            <label class="mt-2" for="email">メールアドレス</label>
            <input v-model="email" class="u-bg-tr text-left pl-2" type="email" name="email" id="email" placeholder="メールアドレスを入力してください。" required>      
            
            <label class="mt-2" for="pass">パスワード</label>
            <input v-model="pass" class="u-bg-tr text-left pl-2" type="password" name="pass" id="pass" placeholder="パスワードを入力してください。">
            <input v-model="repass" class="u-bg-tr text-left pl-2" type="password" name="repass" id="repass" placeholder="再度パスワードを入力してください。" required>
      
            
            <button @click.prevent="doRegisteration" class="btn btn-light w-100 u-text-pink mt-5">新規登録</button>
          </form>


        </section>
        
      </article>
    `
  }


</script>