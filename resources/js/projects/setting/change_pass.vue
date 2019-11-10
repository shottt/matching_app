<script>
const usr = new URLSearchParams();

export default {
  props: {
    pattern: String,
    //search_query: String
  },
  data: function () {
    return {
      button_obj: {
        pass_now: "",
        pass_new: "",
        pass_new__re: "",
      }
    }
  },
  computed: {
    page: function() {
      
    }
  }, 
  template: `
  <main class="u-container-y--short">
    <div class="container">
      
      <form class="search-Form text-left mt-5">

        <label class="u-txt-b" for="pass_now">現在のパス</label>
        <input v-model="button_obj.pass_now" class="u-bt-border-grey w-100 text-dark" type="password" id="pass_now">
        

        <label class="u-txt-b mt-5" for="pass_new">新しいパス</label>
        <input v-model="button_obj.pass_new" class="u-bt-border-grey w-100 text-dark" type="password" id="pass_new">
       

        <label class="u-txt-b mt-5" for="pass_new__re">もう一度新しいパスを入力してください</label>
        <input v-model="button_obj.pass_new__re" class="u-bt-border-grey w-100 text-dark" type="password" id="pass_new__re">
       

        <action_btn btn_text="パスを変更する" v-bind:button_obj="button_obj"></action_btn>
      </form>

    </div>
  </main>`
}
</script>