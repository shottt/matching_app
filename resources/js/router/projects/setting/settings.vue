<script>

import { mapGetters } from 'vuex';
const usr = new URLSearchParams();

export default {
  
  props: {

  },
  data: function() {
    return {
      pattern: "settings",
    }
  },
  methods: {
    push_About_me: function () {
      this.$router.push({ path: '/my_profile' })
    },
    change_Page_Pattern: function (pattern) {

      //settings
      console.log("setting:change_Page_Pattern");
      this.$store.dispatch('page_displaying/pattern_' + pattern);


      //console.log("1 :" + this.pattern);
      //console.log("2 :" + this.$store.getters['page_displaying/getPattern_Vuex']);
    
      //console.log(this.$store.getters['page_displaying/getPattern_Vuex']);
    },
    doSign_out: function () {

      //サインイン jsonで投げる ※bootsrap.jsで$httpにaxiosを代入してる
      this.$http.post('/api/ctrl_sign_out', {
        user_id: this.$store.getters['user_info/getUser_id']
        })
        .then(res => {
          console.log("サインアウト");
          
          //描画のための画面判定値を更新
          this.$store.dispatch('page_displaying/pattern_top')
          this.$router.push({ path: '/' })
        })
        .catch(err => console.log(err))
        .finally(() => {
          console.log('finally')
        });

    },

    unSubscripton: function () {

      //サインイン jsonで投げる ※bootsrap.jsで$httpにaxiosを代入してる
      this.$http.post('/api/ctrl_unsubscription', {
        //user_id: this.$store.getters['user_info/getUser_id']
        })
        .then(res => {
          console.log("サインアウト");
          
          //描画のための画面判定値を更新
          this.$store.dispatch('page_displaying/pattern_top')
          this.$router.push({ path: '/' })
        })
        .catch(err => console.log(err))
        .finally(() => {
          console.log('finally')
        });

    },

  },
  computed: {
    ...mapGetters([
    'page_displaying/getPattern_Vuex',
    'user_info/getUser_id',
    ]),
  },
  template: `
    <main class="u-container-y--short">
      <div class="container">


        <router-link class="d-block mt-3" to="/my_profile">
          <div @click="change_Page_Pattern('my_Prof')">プロフィール確認する</div>
        </router-link>

        <div @click="change_Page_Pattern('set_Prof')">
          <router-link class="d-block mt-3" to="/set_Prof">プロフィール編集</router-link>
        </div>

        <div @click="change_Page_Pattern('set_Pass')">
          <router-link class="d-block my-3" to="/set_Pass" >パスワード変更</router-link>
        </div>

        <p class="d-block my-3" data-toggle="modal" data-target="#sign_out">
          サインアウト
        </p>

        <p class="d-block my-3" data-toggle="modal" data-target="#unSub">
          退会処理
        </p>




        <!-- モーダルの設定 -->
        <div class="modal fade" id="sign_out" tabindex="-1" role="dialog" aria-labelledby="sign_outLabel">
          <div class="modal-dialog modal-margin" role="document">
            <div class="modal-content w-75 u-mx-a p-4 text-center">
              <dl>
                <dt id="exampleModalLabel" class="modal-title u-txt-b">サインアウトしますか？</dt>
                <dd class="u-txt-b">Are you sure you wish to sign out?</dd>
              </dl>
              <div class="sing_out_button">
                <a @click.prevent="doSign_out" class="u-txt-p p-3 u-bg-grey3 d-inline-block u-w-40" data-dismiss="modal">はい</a>
                <a class="u-txt-grey p-3 u-bg-grey3 d-inline-block u-w-40" data-dismiss="modal">いいえ</a>
              </div>
            </div><!-- /.modal-content -->
          </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

        <!-- モーダルの設定 -->
        <div class="modal fade" id="unSub" tabindex="-1" role="dialog" aria-labelledby="sign_outLabel">
          <div class="modal-dialog modal-margin" role="document">
            <div class="modal-content w-75 u-mx-a p-4 text-center">
              <dl>
                <dt id="exampleModalLabel" class="modal-title u-txt-b">本当に退会されますか？</dt>
                <dd class="u-txt-b">Are you sure you wish to unbSubscribe ?</dd>
              </dl>
              <div class="sing_out_button">
                <a @click.prevent="unSubscripton" class="u-txt-p p-3 u-bg-grey3 d-inline-block u-w-40" data-dismiss="modal">はい</a>
                <a class="u-txt-grey p-3 u-bg-grey3 d-inline-block u-w-40" data-dismiss="modal">いいえ</a>
              </div>
            </div><!-- /.modal-content -->
          </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

      </div>
    </main>

  `
}
</script>

<style lang="scss" scoped>

.modal-margin {
  margin-top: 35vh;
}
.sing_out_button {
  a:hover {
    cursor: pointer;
  }
}

</style>
