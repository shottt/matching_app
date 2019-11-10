<script>
export default {

  data: function () {
    return {
      search_query: ""
    }
  },
  template: `
  <main class="u-container-y">
    <div class="container-fluid">
      
      <form class="search-Form text-center" action="">
        <label class="my-5 u-txt-b" for="search-key">キーワードを入力してください</label>
        <input v-model="search_query" class="u-bt-border-grey w-100 text-dark" type="text" id="search-key" name="search-key">
        {{ search_query }}
        <action_btn btn_text="検索する" v-bind:search_query="search_query" ></action_btn>
      </form>

    </div>
  </main>`
}
</script>