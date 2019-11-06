<script>
  import { mapGetters } from 'vuex';
  //import action_btn from '/components/action-btn_follow.vue';

  export default {
    props: {
      pattern: String
    },
    components: {
      
    },
    computed: {
      ...mapGetters([
      'page_displaying/getPattern_Vuex',
      'user_info/getUser_id',
      ]),
    },
    methods: {
      change_Page_Pattern: function (pattern) {
        console.log("change_Page_Pattern");
        this.$store.dispatch('page_displaying/pattern_set_' + pattern);
      },
    },
    template: `
    <tr class="container c-PsnCard u-bt-border-grey">
      <th class="u-w-30">
        <figure class="c-PsnCard__img my-3 mx-2">
          <img src="/images/avator2.png" class="img-fluid" alt="">
        </figure>
      </th>
      <td class="text-left u-txt-b c-PsnCard__text">
          北斗の拳
      </td>
    </tr>
    `
  }

</script>

<style lang="scss" scoped>
.c-PsnCard__img {
  border-radius: 10px;
  overflow: hidden;
}
.c-PsnCard__text {
  vertical-align: middle;
  position: relative;
}
.c-PsnCard__text:after {
  background:  url('/images/options-icon.png');
  content: "";
  display: inline-block;
  width: 20px;
  height: 5px;
  text-align: right;
  position: absolute;
  right: 15px;
  top: 0;
  bottom: 0;
  margin-top: auto;
  margin-bottom: auto;
}
</style>