<script>

//これらのコンポーネントを含めて、Vue Routerを通して描画したい
import main_content from "./sign-register.vue";
import button_content from "./button-sign-register.vue";



  export default {
    props: {
      pattern: String
    },
    components: {
      main_content,
      button_content
    },
    template: `
      <main class="container u-conainer-y text-center">
        <main_content></main_content>
        <button_content></button_content>
      </main>
    `
  }
</script>


<!--
<main class="container u-conainer-y text-center">
  <router-view　name=""content></router-view>
  <router-view　name=""button></router-view>
</main>

--->