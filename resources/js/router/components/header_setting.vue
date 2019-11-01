
<script>
  import { mapGetters } from 'vuex';
  import VueRouter from 'vue-router'
  import search_icon from './search_icon.vue';
  const usr = new URLSearchParams();
  
  export default {
    props: {
      pro_pattern: String,
      search_query: String
    },
    components: {
      search_icon,
    },
    data: function () {
      return {
        pattern: "Setting",
        
      }
    },
    methods: {
      change_Page_Pattern: function () {
        console.log("change_Page_Pattern");
        this.$store.dispatch('page_displaying/pattern_search')
      }
    },
    computed: {
      ...mapGetters([
      'page_displaying/getPattern_Vuex'
      ]),
      //サインインか登録の描画判定のフラグです
      page_pattern: function () {
        
        this.pattern = this.$store.getters['page_displaying/getPattern_Vuex'];
        console.log("headr_settings");
        console.log("computed : " + this.pattern);
        //return this.pattern;
        //return this.pattern;
      },
    },


  //検索キーワード表示はまだ

    template: `
    <header class="c-Header--short">
      <div class="c-Header--short__inner">
        <h1 class="u-text-pink text-center"> {{ $store.state.page_displaying.pattern }} </h1>
      </div>
    </header>
    `
  }

</script>

<!--
<header class="c-Header">
<h1 class="u-text-pink text-center">検索<a class="c-right-icon" href="/search"><img src="/images/close-icon.png" alt=""></a></h1>
<a class="u-down-arrow u-txt-b d-block text-center mt-3" href="./filter.html">フィルター</a>
<div class="c-Header__tabs row">
  <div class="col text-center u-bt-border--pink">
    <a class="u-txt-p" href="">友達</a>
  </div>
  <div class="col text-center">
    <a class="u-txt-grey" href="">投稿</a>
  </div>
</div>
</header>


<header class="c-Header--short">
<div class="c-Header--short__inner">
<p class="position-relative u-txt-b text-left u-pl-40">
  <a class="c-left-icon" href="/search"><img src="/images/arrow-left-icon.png" alt=""></a>
  写真家
  <a class="c-right-icon" href="/search"><img src="/images/close-icon.png" alt=""></a>
<p>
</div>
</header>*/

export default header;-->