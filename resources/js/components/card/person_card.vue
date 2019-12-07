<script>
  export default {
    data: function () { return {
      friends: this.$store.getters['user_info/getFriends_Vuex'],
      }
    },
    methods: {
      showProfile: function (user_id) {
        //IDをフックさせてプロフィールを表示する ctrl_profile
        this.$http.post('/api/ctrl_user_profile', {
            user_id: user_id,
        })
        .then(res => {
          console.log("サインイン成功");
          this.json_data = res.data;
          console.log("user: " + this.json_data.friend);
          console.log("result_flag : " + this.json_data.result_flag);

          //結果判定
          if (this.json_data.result_flag === true) {

            //ユーザー情報
            this.$store.dispatch('user_info/user', this.json_data.friend);

            //描画のための画面判定値を更新
            this.change_Page_Pattern('page_displaying/set_Vuex__pattern', "user_profile");
            this.$router.push({ path: '/user_profile' });

          } else {
            alert("サインイン失敗です。");
          }
        })
        .catch((err) => {
          console.log(err)
        })
        .finally(() => {
          console.log('finally')
        });

        // this.$store.dispatch('page_displaying/set_Vuex__pattern', "user_profile");
        //this.$router.push({ path: '/user_profile' });
      }
    },
    template: `
    <li class="container bg-white">
      <dl v-for="friend in friends" class="row align-items-center c-PsnCard u-bt-border-grey mb-0">
        <dt class="col-4 d-inline-block">
          <figure class="c-PsnCard__img my-3 mx-2">
            <img src="/images/avator2.png" class="img-fluid" alt="">
          </figure>
        </dt>
        <dd class="col-8 pl-0 text-left u-txt-b c-PsnCard__text">
          {{ friend.name }}<br><span class="u-txt-grey">{{ friend.occupation }}</span>
          <i v-on:click="showProfile(friend.id)" class="u-icon__detail"></i></router-link>
        </dd>
      </dl>
    </li>
    `
  }

</script>

<style lang="scss" scoped>

.c-PsnCard__img {
  border-radius: 10px;
  overflow: hidden;
}
.c-PsnCard__text {
  //vertical-align: middle;
  position: relative;
  margin-bottom: 0;
  max-width: 200px;
}
.u-icon__detail:after {
  background:  url('/images/options-icon.png') no-repeat;
  content: "";
  display: inline-block;
  width: 20px;
  height: 5px;
  text-align: right;
  position: absolute;
  right: -40px;
  top: 0;
  bottom: 0;
  margin-top: auto;
  margin-bottom: auto;
}
</style>