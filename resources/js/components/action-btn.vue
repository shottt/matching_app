<script>
export default {
  props: {
    pattern: String,
    btn_text: String,
    search_query: String
  },
  methods: {
    change_Page_Pattern: function () {
      console.log('page_displaying/pattern_' + this.pattern);
      this.$store.dispatch('page_displaying/pattern_' + this.pattern)
    },
    search_for: function () {
      
      //描画変更先でレイアウトやテキストを動的に変えるため、pattern変更
      this.change_Page_Pattern();

      //axios通信
      //Post値　準備
      //usr.append('search_query', this.search_query);

      //CSRFトークン送信準備
      //let token = $('meta[name="csrf-token"]').attr('content');
      console.log(this.$http);

      //サインイン jsonで投げる ※bootsrap.jsで$httpにaxiosを代入してる
      this.$http.post('/api/ctrl_search_for_frends', {
          search_query: this.search_query,
      })
      .then(res => {
        console.log("検索成功");

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
    <button @click="search_for" type="button" class="btn w-100 bg-main u-mt-200 position-relative text-light">

     <router-link :to="{ name: 'search_result', params: { query : search_query } }">
      <img class="pr-1" src="/images/search-icon-white.png" style="display: inline-block; vertical-align: sub;" alt="">
      {{ btn_text }}   
     </router-link>

    </button>
  `
}
</script>