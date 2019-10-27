<script>

//これらのコンポーネントを含めて、Vue Routerを通して描画したい
import button_ from "./button-sign-register.vue";
import main_content from "./sign-register.vue";


  export default {
    /*
    components: {
      main,
      button
    },*/
    template: `
      <main class="container u-conainer-y text-center">
        <p>test</p>
        <button>test</button>
        <p>調整中</p>
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