<script>
import { mapGetters } from 'vuex';
import post_card from '../../../components/post_card.vue';

  export default {
    props: {
      pattern: String
    },
    components: {
      post_card,
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
    <dl>
      <post_card></post_card>
    </dl>
    `
  }

</script>

<style lang="scss" scoped>

.top_Hero {
  background: url("/images/avator1.png") center no-repeat;
}

.u-wrapper {

}

.u-wrapper:hover {
  cursor: pointer;
}
.u-wrapper:hover > .u-wrapper-text {
  border-bottom: solid 2px #F271A8;
  transition: border-bottom 1s;
}

.u-wrapper-text {
  text-align: center;
  width: 100%;
  padding: 1rem 0;
}

.u-wrapper-text p {
  color: #343a40;
}

.js-border {
  border-bottom: solid 2px #F271A8;
}

.profile-Thumb {
  margin-bottom: 0;
  position: absolute;
  top: -15px;
  left: 0;
  right: 0;
  display: inline-block;
  margin: 0 auto;
  width: 70px;
  border-radius: 4px;
  border: solid #fff 2px;
}
.profile-Me {
  margin-top: 30px;
}
.profile-Detail__head {
  color: #343a40;
}
.profile-Detail__text {
  color: #343a40;
}
</style>