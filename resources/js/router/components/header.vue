
<script>
  import { mapGetters } from 'vuex';
  const usr = new URLSearchParams();
  
  export default {
    props: {
      //pattern: String
    },
    data: function () {
      return {
        pattern: "aaa",
        test: 11
      }
    },      
    computed: {
      ...mapGetters([
      'page_displaying/getPattern_Vuex'
      // ...
      ]),
      //サインインか登録の描画判定のフラグです
      page_pattern: function () {
        //後ほどpropsを変化させて、propsでbutton表示判定させたい
        this.pattern = this.$store.getters['page_displaying/getPattern_Vuex'];
        return this.pattern;
      },
    },
    template: `
      <header class="c-Header">{{ this.test }}
        <h1 class="u-text-pink text-center">
          <router-link class="c-right-icon" to='/search'>
            <img src="/images/search-icon.png" alt="">
          </router-link>
        </h1>
        <a class="u-down-arrow u-txt-b d-block text-center mt-3" href="./filter.html">フィルター</a>
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