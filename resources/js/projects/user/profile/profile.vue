<script>
  //自分以外のユーザープロファイル
  //vuexからユーザーデータをとってくる
  export default {

    data: function() {return {
       page_pattern: "",
       user: {},//this.$store.getters['user_info/getUser_Vuex'],
    
    }},

    mounted: function() {
     
        this.$nextTick(function () {
        // 子のコンポがレンダリングされた後にのみ実行されるコード
        //なにこれ　なんのため？ なんか意味があった気がする
        this.user = this.$store.getters['user_info/getUser_Vuex'];
        this.pattern_data = this.$store.getters['page_displaying/getPattern_Vuex'];
      })
    },
/*
    methods: {
      show_My_Friends: function () {

        //友達リストを作ってvueのstateをmutate
        //this.$http.post('/api/ctrl_all_friends', {
        this.$http.post('/api/ctrl_all_friends', {
          user_id: this.$store.getters['auth_displaying/getMy_Data_Vuex'].id
        })
        .then(res => {
          this.json_data = res.data;
          if (this.json_data.result_flag === false) {
            alert("通信成功しましたが、該当データ見当たらないです。");
            return;
          }

          this.change_Page_Pattern('settings_result');
          console.log("検索成功");

          this.$store.dispatch('user_info/friends', this.json_data);
          this.$router.push('/user_friends');

        })
        .catch(err => console.log(err))
        .finally(() => {
          console.log('finally')
        });

          
    },*/
    methods: {
      show_My_Friends: function () {

        //仮のコード
        //友達リストを作ってvueのstateをmutate
        this.$http.post('/api/ctrl_all_friends', {
          user_id: this.user.id
        })
        .then(res => {
          this.json_data = res.data;

          if (this.json_data.result_flag === false) {
            alert("通信成功しましたが、該当データ見当たらないです。");
            return;
          }
          console.log("検索成功");
          this.change_Page_Pattern('user_friends');
        
          this.$store.dispatch('user_info/friends', this.json_data.friends);
          this.$router.push('/user_friends');

        })
        .catch(err => console.log(err))
        .finally(() => {
          console.log('finally')
        });
      },
      start_chat: function () {

        this.change_Page_Pattern('chat');
        this.$router.push({name:'chat', query:{ id: this.user.id},});
      },
    },
      
    template: `
    <main class="text-center u-bg-w u-pb-180">
      <div class="c-Card-Hero">
        <img class="w-100" v-bind:src="user_data.picture" alt="">
        <dl class="c-Card-Hero__detail text-center">
          <dt class="">{{ user.name }}</dt>
          <dd style="opacity: 0.5;">{{ user.occupation }}</dd>
          <dd class="mt-2 mb-4">ほし</dd>
        </dl>
      </div>

      <div class="u-Sticky">
        <div @click="start_chat()">
          <p class="w-100 bg-main text-light d-inline-block py-2" to="/chat">
          メッセージを送る
          </p>
        </div>

        <div class="container-fluid u-bg-w u-bt-border-grey">
          <ul class="row l-Simple__list">

            <div class="col">
              <div class="u-wrapper">
                <div class="u-wrapper-text d-position-relative">
                <router-link to="/user_profile">
                  <figure class="profile-Thumb">
                    <img src="/images/avator1.png" class="img-fluid">
                  </figure>
                  <p class="profile-Me">私について</p>
                </router-link>
                </div>
              </div>
            </div>

            <div class="col">
              <div class="u-wrapper">
                <div class="u-wrapper-text">
                  <div @click="show_My_Friends">
                    <p>友達</p>
                  </div>
                </div>
              </div>
            </div>

            <div class="col">
              <div class="u-wrapper">
                <div class="u-wrapper-text">
                <router-link to="/user_friend_reviews">
                  <p>友達の声</p>
                </router-link>
                </div>
              </div>
            </div>
            
            <div class="col">
              <div class="u-wrapper">
                <div class="u-wrapper-text">
                  <router-link to="/user_posts">
                    <p>投稿</p>
                  </router-link>
                </div>
              </div>
            </div>
          </ul>
        </div>
      </div>

    　<router-view name="user_profile"></router-view>
      <router-view name="user_friends"></router-view>
      <router-view name="user_friend_reviews"></router-view>
      <router-view name="user_posts"></router-view>

    </main>
    `
  }

</script>

<style lang="scss" scoped>

.top_Hero {
  background: url("/images/avator1.png") center no-repeat;
}

.u-Sticky {
  position: -webkit-sticky; /* safari用 */
  position: sticky;
  z-index: 1;
  top: 0;
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