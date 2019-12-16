<script>
//実装のポイント
//⑴自分と相手のIDをどうってくるか？
//
//⑵相手が自分かの判定
//相手なら <li class="Chat__friend">
//自分なら<li class="Chat__me">
//という風にCSSクラスを切り替える

//⑶スクロールに表示コメント数を合わせたい
//最新20件だけとってくる

//⑷コメントはcreated_atの順で。
import comments from './post_form.vue';
import post_card from '../../components/card/post_card.vue';
export default {
  data: function () { return {
    comments: {},
  }},
  beforeMount: function () {
    return;
    comments = this.get_Posts(true);
  },
  //子のcomment_form.vueから「コメントが増えた」と信号を受け取る。
  methods: {
    get_get_Posts: function (get_flag) {

      if (get_flag !== true) {
        return;
      }
        this.$http.post('/api/ctrl_get_posts', {
        my_id: this.$store.getters['auth_displaying/getMy_Data_Vuex'].id,
        user_id: this.$store.getters['user_info/getUser_Vuex'].id,
      })
      .then(res => {

        if (res.data.result_flag === false) {
          alert("コメント取得に失敗しました");
          return;
        }
        this.change_Page_Pattern('chat');
        console.log("成功");

      })
      .catch(err => console.log(err))
      .finally(() => {
        console.log('finally')
      });
    },
  },
  components: {
    post_card,
  },
  template: `
  <main class="text-center u-bg-w u-pb-180 u-pt-100">
    <post_card></post_card>
    <i class="fas fa-plus-circle"></i>
  </main>`
}
</script>

<style lang="scss" scoped>


i {
  position: fixed;
  bottom: 100px;
  right: 20px;
  &:before {
    display: inline-block;
    text-align: center;
    padding-top:5px;
  }
}
i:before {
  font-size: 50px;
  color: #F271A8;
  transition: all;
}
i:hover {
  cursor: pointer;
  &:before {
    font-size: 55px;
    transition: all;
  }
}
i:active {
    &:before {
    font-size: 50px;
    transition: all;
  }
}
</style>

