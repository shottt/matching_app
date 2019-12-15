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
import comments from './comment_form.vue';
export default {
  data: function () { return {
    chat_comments: {},
    my_id: this.$store.getters['auth_displaying/getMy_Data_Vuex'].id,
    user_id: this.$store.getters['user_info/getUser_Vuex'].id,
    chat_id: 0,
    chat_props: {
      chat_id: 0,
      chat_length: 10,
    },
    scrollY: 0,
    scroll_cnt: 1,
  }},
  created: function () {
    this.$nextTick(function () {
      //初期レンダリング時コメントを取得
      this.get_Comment(true);
    });
    window.addEventListener('scroll', this.get_Chat_Scroll);
  },
  computed: {
    chat_comments_displayed: function () {
      return this.chat_comments;
    },
    chat_length_cm: function () {
      this.chat_props.chat_length = this.chat_comments.length;
      return this.chat_props.chat_length;
    }
  },
  //子のcomment_form.vueから「コメントが増えた」と信号を受け取る。
  methods: {
    get_Comment: function (get_flag,) {
      if (get_flag !== true) {
        return;
      } 
      console.log();

      this.$http.post('/api/ctrl_get_chat', {
        my_id: this.my_id,
        user_id: this.user_id,
      })
      .then(res => {

        if (res.data.result_flag === false) {
          alert("コメント取得に失敗しました");
          return;
        }

        this.change_Page_Pattern('chat');
        this.chat_comments = res.data.comments; 
        this.reverse_Comments();
        this.chat_props.chat_id = this.chat_comments[0].chat_id;
        this.chat_props.chat_length = this.chat_comments.length

        return this.chat_comments;
        console.log("成功");

      })
      .catch(err => console.log(err))
      .finally(() => {
        console.log('finally')
      });
    },

    get_new_comment: function (get_flag) {
      if (get_flag !== true) {
        return;
      }

      this.$http.post('/api/ctrl_get_new_chat', {
        chat_id: this.chat_props.chat_id,
      })
      .then(res => {

        if (res.data.result_flag === false) {
          alert("最新コメント取得に失敗しました");
          return;
        }

        this.change_Page_Pattern('chat');
        
        //chat_commentsに追加
        console.log(res.data.comment);
        this.chat_comments.push(res.data.comment);

        //this.chat_props.chat_id = this.chat_comments[0].chat_id;
        //this.chat_props.chat_length = this.chat_comments.length;

        return this.chat_comments;
        console.log("成功");

      })
      .catch(err => console.log(err))
      .finally(() => {
        console.log('finally')
      });
    },

    reverse_Comments: function () {
      this.chat_comments = this.chat_comments.slice().reverse();
      
    },
    get_Chat_Scroll() {
      this.scrollY = window.scrollY;
      if (this.scrollY >= 500) {
      this.$http.post('/api/ctrl_get_chat', {
        chat_id: this.chat_props.chat_id,
      })
      .then(res => {

        if (res.data.result_flag === false) {
          alert("コメント取得に失敗しました");
          return;
        }

        this.change_Page_Pattern('chat');
        this.chat_comments = res.data.comments; 
        this.reverse_Comments();


        return this.chat_comments;
        console.log("成功");

      })
      .catch(err => console.log(err))
      .finally(() => {
        console.log('finally')
      });
      }
      console.log(this.scrollY);
    }
  },
  components: {
    comments,
  },
  template: `
  <div>
    <main class="u-container-y--short">
      <div class="container">
     
        <ul class="table mb-0 py-5 Chat">
          <li v-for="chat in chat_comments_displayed">
            <div v-if="chat.from_user == my_id" class="Chat__me">
              <p class="text-left p-2 u-txt-b">
              {{chat.detail}}
              </p>
              <time>{{chat.updated_at}}</time>
            </div>

            <div v-if="chat.from_user == user_id" class="Chat__friend">
              <i class="fas fa-male"></i>
              <p class="text-left p-2 u-txt-b">
                {{chat.detail}} 
              </p>
              <time>{{chat.updated_at}}</time>
            </div>
          </li>
        </ul>

        

      </div>
    </main>
    <comments v-on:emit-add-comment="get_new_comment" v-bind:chat_props="chat_props"/>
  </div>`
}
</script>

<style lang="scss" scoped>

.Chat__me,
.Chat__friend{
  position: relative;
  display: block;
  margin-bottom: 32px;
  > p {
    background: #fff;
    border-radius: 10px;
    min-height: 60px;
  }
  time {
    display: block;
  }
}

.Chat__me {

  &:before {
  content: '';
  position: absolute;
  display: block;
  width: 0;
  height: 0;
  right: -10px;
  top: 2px;
  border-left: 20px solid #fff;
  border-top: 10px solid transparent;
  border-bottom: 10px solid transparent;
  transform: rotate(-45deg);
  }

  time {
    text-align: right;
  }
}

.Chat__friend {
  padding-left: 40px!important;

  &:after {
    content: '';
    position: absolute;
    display: block;
    width: 0;
    height: 0;
    left: 30px;
    top: 2px;
    border-left: 20px solid #fff;
    border-top: 10px solid transparent;
    border-bottom: 10px solid transparent;
    transform: rotate(225deg);
  }


  time {
    text-align: left;
  }

  i {
    position: absolute;
    top: 0;
    bottom: 0;
    left: 0;
    width: 30px;
    overflow: hidden;
    &:before {
      font-size: 60px;
    }
  }

}

.Chat-Form {
@at-root {
  .Chat-Form__file {
    i {
      &:before {
        font-size: 24px;
      }
    }
  }
  .Chat-Form__comment {
    
  }
  .Chat-Form__btn {
    
  }
}}
</style>

