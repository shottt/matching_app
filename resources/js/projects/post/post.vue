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
export default {
  data: function () { return {
    comments: {},
  }},
  beforeMount: function () {
    comments = this.get_Comment(true);
  },
  //子のcomment_form.vueから「コメントが増えた」と信号を受け取る。
  methods: {
    get_Comment: function (get_flag) {

      if (get_flag !== true) {
        return;
      }

      this.$http.post('/api/ctrl_get_chat', {
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
    comments,
  },
  template: `
  <div>
    <main class="u-pt-100 u-pb-80">

      <div class="u-py-30">
        <ul class="table mb-0 ">



          <li class="Post py-3 u-pl-100 u-pr-60 u-top-border-grey">
            <i class="fas fa-user-injured"></i>
            <div class="Post__header">
              <p class="u-txt-b mr-3">ほしのあき</p>
              <time class="u-txt-b text-right">2019 11 02</time>
            </div>
            

            <p class="text-left my-2 u-txt-b">
              friend friend friend friend friend friend friend friend friend friend 
            </p>
            <figure class="Post__img m-0">
              <img src="/images/avator2.png" class="img-fluid" alt="">
            </figure>
          </li>

          <li class="Post py-3 u-pl-100 u-pr-60 u-top-border-grey">
            <i class="fas fa-user-injured"></i>
            <div class="Post__header">
              <p class="u-txt-b mr-3">ほしのあき</p>
              <time class="u-txt-b text-right">2019 11 02</time>
            </div>
            

            <p class="text-left my-2 u-txt-b">
              friend friend friend friend friend friend friend friend friend friend 
            </p>
            <figure class="Post__img m-0">
              <img src="/images/avator2.png" class="img-fluid" alt="">
            </figure>
          </li>
          

          <li class="Post py-3 u-pl-100 u-pr-60 u-top-border-grey">
            <i class="fas fa-user-injured"></i>
            <div class="Post__header">
              <p class="u-txt-b mr-3">ほしのあき</p>
              <time class="u-txt-b text-right">2019 11 02</time>
            </div>
            

            <p class="text-left my-2 u-txt-b">
              friend friend friend friend friend friend friend friend friend friend 
            </p>
            <figure class="Post__img m-0">
              <img src="/images/avator2.png" class="img-fluid" alt="">
            </figure>
          </li>

          <li class="Post py-3 u-pl-100 u-pr-60 u-top-border-grey">
            <i class="fas fa-user-injured"></i>
            <div class="Post__header">
              <p class="u-txt-b mr-3">ほしのあき</p>
              <time class="u-txt-b text-right">2019 11 02</time>
            </div>
            

            <p class="text-left my-2 u-txt-b">
              friend friend friend friend friend friend friend friend friend friend 
            </p>
            <figure class="Post__img m-0">
              <img src="/images/avator2.png" class="img-fluid" alt="">
            </figure>
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
  min-height: 100px;
  background: #fff;
  width: calc(100% - 30px);
  margin-left: 15px;
  margin-right: 15px;
  &:last-child {
    border-bottom: solid 2px #E2E8ED;
  }
  > p {
    
    min-height: 60px;
  }
  time {
    display: block;
  }
}

.Post {

  i {
    position: absolute;
    top: 18px;
    bottom: 0;
    left: 20px;
    width: 55px;
    overflow: hidden;
    &:before {
      font-size: 60px;
      color: blue;
      z-index: 2;
    }
  }

}
.Post__header {
  p {
    display: inline-block;
  }
  time {
    display: inline-block;
  }
}
.Post__img {
  text-align: right;
  max-height: 200px;
  img {
    display: inline-block;

    border-radius: 10px;
    width: 40%;
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

