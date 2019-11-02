<script>
import { mapGetters } from 'vuex';
const usr = new URLSearchParams();

export default {
  props: {
    pattern: String,
    btn_text: String,
    prof_data: Object
  },
  computed: {
    ...mapGetters([
    'auth_displaying/getDisplay_Vuex',
    'page_displaying/getPattern_Vuex',
    'user_info/getUser_id',
    // ...
    ]),
  },
  methods: {
    change_Page_Pattern: function () {
      this.$store.dispatch('page_displaying/pattern_settings');
    },
    set_prof: function () {
      
      //描画変更先でレイアウトやテキストを動的に変えるため、pattern変更 いらんかも
      //this.change_Page_Pattern();

      //axios通信
      //Post値　準備
      //usr.append('pass_now', this.pass_now);
      //usr.append('pass_new', this.pass_now);
      //usr.append('user_id', this.$store.getters['user_info/getUser_id']);

      //CSRFトークン送信準備
      console.log(this.$http);

      //サインイン jsonで投げる ※bootsrap.jsで$httpにaxiosを代入してる
      this.$http.post('/api/ctrl_set_prof', {
        user_id: this.$store.getters['user_info/getUser_id'],
        prof_data: this.prof_data,
      })
      .then(res => {
        console.log("プロフィール更新成功");
        this.change_Page_Pattern();
        this.json_data = res.data;
        console.log(this.json_data);
      })
      .catch(err => console.log(err))
      .finally(() => {
        console.log('finally')
      });

    }
  },
  template: `
    <button @click="set_prof" type="button" class="btn w-100 bg-main u-mt-200 position-relative text-light">

     <router-link to="/settings">
      <img class="pr-1" src="/images/search-icon-white.png" style="display: inline-block; vertical-align: sub;" alt="">
      {{ btn_text }}   
     </router-link>

    </button>
  `
}
</script>