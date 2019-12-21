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
    
    post_action: "投稿",
    post_content: {
      comment: "",
    },
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
    cancel_post: function () {
      this.post_action = "投稿";
    },

    draft_post: function () {
      
      //下書きする
      if (this.post_action === "投稿") {
        //下書きのdataとvuexが完全に繋がってしまう。一度繋げて、そして切りたい。どうしたらいいかな？
        this.$store.dispatch('auth_displaying/set_draft_post',this.post_content);
        this.post_action = "編集";
        return;
      }

      //下書きから投稿に変更
      if (this.post_action === "編集" && this.post_content.comment === "") {
        this.post_action = "投稿";
        return;
      }
      //下書きを参照する
      this.post_action = "編集";
    },
    create_new_post: function () {

    }
  },
  components: {
    post_card,
  },
  template: `
  <main class="text-center u-bg-w u-pb-180 u-pt-100">
    <post_card></post_card>
    <i class="fas fa-plus-circle" data-toggle="modal" data-target="#posting"></i>
    <!-- モーダルの設定 -->

        <div class="modal fade" id="posting" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">

          <div class="modal-dialog" role="document">


            <div class="modal-content">

              <div class="post-My-Action u-align-right u-clearfix u-pl-10">
                <button v-on:click="cancel_post"　type="button" class="btn u-float-l" data-dismiss="modal">閉じる</button>
                <button v-on:click="draft_post" type="button" class="btn is-NoActive mx-3">下書き</button>
                <button type="button" class="btn is-NoActive">{{post_action}}</button>
              </div>
               
              <div class="modal-body">
                <figure class="post-My-Img"><img v-bind:src="my_data.picture" class="img-fluid"/></figure>
                <form v-if="post_action === '投稿'">
                  <textarea v-model="post_content.comment" placeholder="いまどうしてる？" class="post-Txtarea u-txt-b w-100" name="post-text" cols="33"></textarea>
                </form>
                <p class="u-txt-b text-left test" v-if="post_action === '編集'">aaaa</p>
              </div>



            </div><!-- /.modal-content -->

          </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->


  </main>`
}
</script>

<style lang="scss" scoped>

.post-Txtarea {
  height: 30vh;
}
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
form {
  border: none;
}
textarea {
  border: none;
}
.post-My-Img {
  position: absolute;
  left: 10px;
  // top: 40px;
  display: inline-block;
  margin: 0 auto;
  border: solid #fff 2px;
  img {
    width: 60px;
    height: 60px;
    background: #BCC5D3;
    object-fit: cover;
    border-radius: 50%;
    object-position: center;
  }
}
.modal-content {
  padding-right: 10px;
 
  border-radius: 0.7rem;
  height: 90vh;
}
.modal-body {
  padding: 0;
  padding-left: 85px;
  margin-top: 20px;
}
.post-My-Action {
  * {
    color: #F271A8;
    font-size: 18px;
  }
}
.is-NoActive {
  color: #BCC5D3!important;
}
</style>

