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
    change_Page_Pattern: function (pattern) {
      console.log("change_Page_Pattern");
      this.pattern = this.$store.dispatch('page_displaying/pattern_set_' + pattern);
      //console.log(this.$store.getters['page_displaying/getPattern_Vuex']);
    }
  },
  computed: {
    ...mapGetters([
    'page_displaying/getPattern_Vuex'

    ]),
  },
  template: `
    <main class="u-container-y--short">
      <div class="container">

        <div @click="change_Page_Pattern('Prof')">
          <router-link class="d-block mt-5" to="/set_Prof">プロフィール編集</router-link>
        </div>

        <div @click="change_Page_Pattern('Pass')">
          <router-link class="d-block my-3" to="/set_Pass" >パスワード変更</router-link>
        </div>

        <div @click="change_Page_Pattern('Sign_out')">
          <router-link class="d-block my-3" to="/set_Sign_out">サインアウト</router-link>
        </div>

        <div @click="change_Page_Pattern('Unsub')">
          <router-link class="d-block my-3" to="/set_Unsub">大会処理</router-link>
        </div>
      
      </div>
    </main>

  `
}
</script>

<style>


</style>
