<script>
import { mapGetters } from 'vuex';
const usr = new URLSearchParams();
import action_btn from '../../components/action-btn.vue';

export default {
  props: {
    pattern: String,
    //search_query: String
  },
  data: function () {
    return {
      search_query: ""
    }
  },
  computed: {
    ...mapGetters([
    'auth_displaying/getDisplay_Vuex',
    'page_displaying/getPattern_Vuex'

    ]),
  },
  components: {
    action_btn
  },
  template: `
  <main class="u-container-y">
    <div class="container-fluid">
      
      <form class="search-Form text-center" action="">
        <label class="my-5 u-txt-b" for="search-key">キーワードを入力してください</label>
        <input v-model="search_query" class="u-bt-border-grey w-100 text-dark" type="text" id="search-key" name="search-key">
        {{ search_query }}
        <action_btn btn_text="検索する" pattern="search_result" v-bind:search_query="search_query" ></action_btn>
      </form>

    </div>
  </main>`
}
</script>