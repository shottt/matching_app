<script>
import { mapGetters } from 'vuex';
const usr = new URLSearchParams();
import action_btn from '../../components/action-btn__prof.vue';

export default {
  props: {
    pattern: String,
    //search_query: String
  },
  data: function () {
    return {
      prof_data: {
        name: "",
        occupation: "",
        birthday: "",
        prof_header: "",
        prof_paragraph: "",
        image: "",
      }
    }
  },
  computed: {
    ...mapGetters([
    'page_displaying/getPattern_Vuex',
    'user_info/getUser_id',
    ]),
  },
  components: {
    action_btn
  },
  template: `
  <main class="u-container-y container text-center">
      
      <form class="search-Form text-left mt-5">

        <label class="u-txt-b" for="name">お名前</label>
        <input v-model="prof_data.name" class="u-bt-border-grey w-100 text-dark" type="text" id="name">

        <label class="u-txt-b mt-2" for="occupation">ご職業</label>
        <input v-model="prof_data.occupation" class="u-bt-border-grey w-100 text-dark" type="text" id="occupation">
               
        <label class="u-txt-b mt-2" for="birthday">お誕生日</label>
        <input v-model="prof_data.birthday" class="u-bt-border-grey w-100 text-dark" type="text" id="birthday">

        <label class="u-txt-b mt-2" for="prof_header">プロフィールのタイトル</label>
        <input v-model="prof_data.prof_header" class="u-bt-border-grey w-100 text-dark" type="text" id="prof_header">
         
        <label class="u-txt-b mt-2" for="prof_paragraph">プロフィールの説明</label>
        <textarea v-model="prof_data.prof_paragraph" class="u-bt-border-grey w-100 text-dark" type="text" id="prof_paragraph"></textarea>

        <label class="u-txt-b mt-2" for="image">お写真</label>
        <input v-model="prof_data.image" class="u-bt-border-grey w-100 text-dark" type="text" id="image">

        <action_btn btn_text="プロフィールを更新する" pattern="change_pass" v-bind:prof_data="prof_data"></action_btn>
      </form>

    </div>
  </main>`
}
</script>

<style lang="scss" scoped>

</style>