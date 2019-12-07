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
  }},
  created: function () {
    this.chat_comments = this.get_Comment(true);
  },
  //子のcomment_form.vueから「コメントが増えた」と信号を受け取る。
  methods: {
    get_Comment: function (get_flag) {
      if (get_flag !== true) {
        return;
      }
      alert(11);
      this.$http.post('/api/ctrl_get_chat', {
        my_id: this.my_id,
        user_id: this.user_id
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
    comments,
  },
  template: `
  <div>
    <main class="u-container-y--short">
      <div class="container">

        <ul class="table mb-0 py-5 Chat">

          <li class="Chat__me">
            <p class="text-left p-2 u-txt-b">
              me me me me me me me me me me me me
            </p>
             <time>2019 11 02</time>
          </li>

          <li class="Chat__friend">
            <i class="fas fa-male"></i>
            <p class="text-left p-2 u-txt-b">
              friend friend friend friend friend friend friend friend friend friend 
            </p>
            <time>2019 11 02</time>
          </li>
          


          <li class="Chat__me">
            <p class="text-left p-2 u-txt-b">
              me me me me me me me me me me me me
            </p>
            <time>2019 11 02</time>
          </li>

          <li class="Chat__friend">
            <i class="fas fa-male"></i>
            <p class="text-left p-2 u-txt-b">
              friend friend friend friend friend friend friend friend friend friend 
            </p> 
            <time>2019 11 02</time>
          </li>

          <li class="Chat__friend">
            <i class="fas fa-male"></i>
            <p class="text-left p-2 u-txt-b">
              friend friend friend friend friend friend friend friend friend friend 
            </p> 
            <time>2019 11 02</time>
          </li>

          <li class="Chat__me">
            <p class="text-left p-2 u-txt-b">
              me me me me me me me me me me me me
            </p>
            <time>2019 11 02</time>
          </li>       
          
          <li class="Chat__me">
            <p class="text-left p-2 u-txt-b">
              me me me me me me me me me me me me
            </p>
            <time>2019 11 02</time>
          </li>

        </ul>
      </div>
    </main>
    <comments v-on:emit-add-comment="get_Comment"/>
  </div>`
}
</script>

<style lang="scss" scoped>

li {
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

