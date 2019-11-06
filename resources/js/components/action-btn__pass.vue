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
  data: function (){
    return {
      json_data: JSON
    }
  },

  methods: {
    change_Page_Pattern: function (pattern) {
      this.$store.dispatch('page_displaying/pattern_settings');
    },
    change_Pass: function () {
      
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
      this.$http.post('/api/ctrl_change_pass', {
        pass_now: this.pass_now,
        pass_new: this.pass_new,
        user_id: this.$store.getters['user_info/getUser_id']
      })
      .then(res => {
        console.log("PASS変更成功");
        this.change_Page_Pattern();
        this.json_data = res.data;
        console.log(this.json_data.pass_now);
        console.log(this.json_data.pass_new);
      })
      .catch(err => console.log(err))
      .finally(() => {
        console.log('finally')
      });

    }
  },
  template: `
    <button @click="change_Pass" type="button" class="btn w-100 bg-main u-mt-200 position-relative text-light">

     <router-link to="/settings">
      <img class="pr-1" src="/images/search-icon-white.png" style="display: inline-block; vertical-align: sub;" alt="">
      {{ btn_text }}   
     </router-link>

    </button>
  `
}
</script>