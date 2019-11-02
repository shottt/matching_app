<script>
import { mapGetters } from 'vuex';
const usr = new URLSearchParams();
import action_btn from '../../components/action-btn__pass.vue';

export default {
  props: {
    pattern: String,
    //search_query: String
  },
  data: function () {
    return {
      pass_now: "",
      pass_new: "",
      pass_new__re: ""
    }
  },
  computed: {
    ...mapGetters([
    'page_displaying/getPattern_Vuex'
    ]),
  },
  components: {
    action_btn
  },
  template: `
  <main class="u-container-y--short">
    <div class="container">
      
      <form class="search-Form text-left mt-5">

        <label class="u-txt-b" for="pass_now">現在のパス</label>
        <input v-model="pass_now" class="u-bt-border-grey w-100 text-dark" type="password" id="pass_now">
        

        <label class="u-txt-b mt-5" for="pass_new">新しいパス</label>
        <input v-model="pass_new" class="u-bt-border-grey w-100 text-dark" type="password" id="pass_new">
       

        <label class="u-txt-b mt-5" for="pass_new__re">もう一度新しいパスを入力してください</label>
        <input v-model="pass_new__re" class="u-bt-border-grey w-100 text-dark" type="password" id="pass_new__re">
       

        <action_btn btn_text="パスを変更する" pattern="change_pass" v-bind:pass_now="pass_now" v-bind:pass_new="pass_new"></action_btn>
      </form>

    </div>
  </main>`
}
</script>