<script>
import { mapGetters } from 'vuex';
const usr = new URLSearchParams();

export default {
  props: {
    pattern: String,
    btn_text: String,
    search_query: String,
    change_pass: String,
    pass_now: String,
    pass_new: String
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
      console.log('page_displaying/pattern_' + this.pattern);
      this.$store.dispatch('page_displaying/pattern_' + this.pattern)
    },
    change_Pass: function () {
      
      //描画変更先でレイアウトやテキストを動的に変えるため、pattern変更 いらんかも
      //this.change_Page_Pattern();

      //axios通信
      //Post値　準備
      usr.append('pass_now', this.pass_now);
      usr.append('pass_new', this.pass_now);
      usr.append('user_id', this.$store.getters['user_info/getUser_id']);

      //CSRFトークン送信準備
      console.log(this.$http);

      //サインイン jsonで投げる ※bootsrap.jsで$httpにaxiosを代入してる
      this.$http.post('http://localhost:8000/api/ctrl_change_pass', {
          params: usr,
      })
      .then(res => {
        console.log("PASS変更成功");
        console.log(this.$http)
        //検索キーワード(search_query)と検索結果が欲しい
        this.json_data = res.data;
      })
      .catch(err => console.log(err))
      .finally(() => {
        console.log('finally')
      });

    }
  },
  template: `
    <button @click="change_Pass" type="button" class="btn w-100 bg-main u-mt-200 position-relative text-light">

     <router-link :to="{ name: 'search_result', params: { query : search_query } }">
      <img class="pr-1" src="/images/search-icon-white.png" style="display: inline-block; vertical-align: sub;" alt="">
      {{ btn_text }}   
     </router-link>

    </button>
  `
}
</script>