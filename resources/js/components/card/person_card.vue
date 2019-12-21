<script>
  export default {
    data: function () { return {
      // friends: this.$store.getters['user_info/getFriends_Vuex'],
      json_data: {},
      // click_flag: false,
      }
    },
    computed: {
      friends: function () {
        return this.$store.getters['user_info/getFriends_Vuex'];
      },
    },
    created: function (){
      this.$nextTick(function () {
        
        //友達リストを作ってvueのstateをmutate
        this.$http.post('/api/ctrl_all_friends', {
          user_id: this.$store.getters['auth_displaying/getMy_Data_Vuex'].id
        })
        .then(res => {
          this.json_data = res.data;

          if (this.json_data.result_flag === false) {
            alert("通信成功しましたが、該当データ見当たらないです。");
            return;
          }
          this.change_Page_Pattern('my_friends');

          for (let i = 0; i < Object.keys(this.json_data.friends).length; i ++) {
            if (this.json_data.friends[i].picture === null) {
              this.json_data.friends[i].picture =  "/images/avator1.png";
            } else {
            this.json_data.friends[i].picture = "data:text/html; charset=UTF-8;base64," + this.json_data.friends[i].picture;
            
            }
          }
          
          this.$store.dispatch('user_info/friends', this.json_data.friends);
          //this.$router.push('/my_friends');

        })
        .catch(err => console.log(err))
        .finally(() => {
          console.log('finally')
        });
      });
    },
    methods: {
      //start_chatから呼び出されると、flag=falseになってpushを止める
      showProfile: function (user_id, flag=true) {
        //IDをフックさせてプロフィールを表示する ctrl_profile
        this.$http.post('/api/ctrl_user_profile', {
            user_id: user_id,
        })
        .then(res => {
          console.log("サインイン成功");
          this.json_data = res.data;
          //結果判定
          if (this.json_data.result_flag === true) {

            //ユーザー情報
            if (this.json_data.friend.picture === null) {
              this.json_data.friend.picture =  "/images/avator1.png";
            } else {
            this.json_data.friend.picture = "data:text/html; charset=UTF-8;base64," + this.json_data.friend.picture;
            
            }
            this.$store.dispatch('user_info/user', this.json_data.friend);
            //描画のための画面判定値を更新
            //this.change_Page_Pattern('');
            if (flag===true) {
              this.$router.push({ path: '/user_profile' });
            }
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
      },
      start_chat: function (user_id) {
        this.showProfile(user_id, false);
        this.change_Page_Pattern('chat');
        this.$router.push({name:'chat', query:{ id: user_id},});
      },

    },
    template: `
    <ul class="table mb-0">
      <li  v-for="friend in friends" class="container bg-white">
        <dl class="row align-items-center c-PsnCard u-bt-border-grey mb-0">
          <dt class="col-4 d-inline-block">
            <figure class="c-PsnCard__img my-3 mx-2">
              <img v-bind:src="friend.picture" class="img-fluid" alt="img">
            </figure>
          </dt>
          <dd class="col-8 pl-0 text-left u-txt-b c-PsnCard__text container">
            <div class="row">

              <p v-on:click="showProfile(friend.id)" class="col-7  u-txt-b">{{ friend.name }}<br><span class="u-txt-grey">{{ friend.occupation }}</span></p>
                
              <div class="col-5 person-card-Action">
                <div class="u-f-l-2">
                  <div @click="start_chat(friend.id)"><i class="far fa-comment person-card-Action_chat"></i></div>
                  <div><i class="far fa-calendar person-card-Action_sche"></i></div>
                </div>
              </div>
              
            </div>
          </dd>
        </dl>
      </li>
    </ul>
    `
  }

</script>

<style lang="scss" scoped>
.c-PsnCard {
  cursor: pointer;
}
.c-PsnCard__img {
  border-radius: 10px;
  overflow: hidden;
}
.c-PsnCard__text {
  //vertical-align: middle;
  position: relative;
  margin-bottom: 0;
   > * {
     height: 60px;
     > * {
       height: 100%;
       display: inline-block;
     }
   }
}
.person-card-Action {
  display: inline-block;
  
  > * {
    border-radius: 15px;
    overflow: hidden;

    i {
      width: 100%;
      text-align: center;
      &:before {
        font-size: 16px;
        display: inline-block;
        margin: auto;
      }
    }
  }
}
.person-card-Click-Flag {
  > i {
    height: 100%;
    padding-top: 15px;
    padding-bottom: 15px;
    &:before {
      display: inline-block;
    }
  }
}
.person-card-Action_chat {
  padding-top: 20px;
  padding-bottom: 20px;
  background: linear-gradient(-135deg, #F271A8, #F5B062) fixed;
  border-right: solid 1px #fff;
}
.person-card-Action_sche {
  padding-top: 20px;
  padding-bottom: 20px;
  background: linear-gradient(-135deg, #F271A8, #F5B062) fixed;
}
.fa-check-circle {
  &::before {
    color: #F271A8;
    font-size: 30px;
  }
}
</style>