<script>

  export default {
    data: function() {
     return {
      pattern_data: "",
      name__displayed: "",
      occupation__displayed: "",
      location__displayed: "",
     }
    },

    mounted: function() {
     
        this.$nextTick(function () {
        // 子のコンポがレンダリングされた後にのみ実行されるコード
        //なにこれ　なんのため？ なんか意味があった気がする
        this.pattern_data = this.$store.getters['page_displaying/getPattern_Vuex'];
        this.name__displayed = this.$store.getters['auth_displaying/getMy_Data_Vuex'].name;
        this.occupation__displayed = this.$store.getters['auth_displaying/getMy_Data_Vuex'].occupation;
        this.location__displayed = this.$store.getters['auth_displaying/getMy_Data_Vuex'].location;
      })
    },
    methods: {
      show_My_Friends: function () {

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
        console.log("検索成功");
        this.change_Page_Pattern('my_friends');
      
        this.$store.dispatch('user_info/friends', this.json_data.friends);
        this.$router.push('/my_friends');

      })
      .catch(err => console.log(err))
      .finally(() => {
        console.log('finally')
      });

        
      },
    },
    template: `
    <main class="text-center u-bg-w u-pb-180">
      <div class="c-Card-Hero">
        <img class="w-100" src="/images/avator1.png" alt="">
        <dl class="c-Card-Hero__detail text-center">
          <dt class="">{{ name__displayed }}</dt>
          <dd style="opacity: 0.5;">{{ occupation__displayed }},{{ location__displayed }}</dd>
        </dl>
      </div>

      <div class="u-Sticky">
        <div @click="change_Page_Pattern('Prof')">
          <router-link class="w-100 bg-main text-light d-inline-block py-2" to="/set_Prof">プロフィール編集</router-link>
        </div>

        <div class="container-fluid u-bg-w u-bt-border-grey">
          <ul class="row l-Simple__list">

            <div class="col">
              <div class="u-wrapper">
                <div class="u-wrapper-text d-position-relative">
                <router-link to="/my_profile">
                  <figure class="profile-Thumb">
                    <img src="/images/avator1.png" class="img-fluid">
                  </figure>
                  <p class="profile-Me">私について</p>
                </router-link>
                </div>
              </div>
            </div>

            <div @click="show_My_Friends" class="col">
              <div class="u-wrapper">
                <div class="u-wrapper-text u-border">
                  <div>
                    <p>友達</p>
                  </div>
                </div>
              </div>
            </div>

            <div class="col">
              <div class="u-wrapper">
                <div class="u-wrapper-text u-border">
                <router-link to="/my_reviews">
                  <p>友達の声</p>
                </router-link>
                </div>
              </div>
            </div>
            
            <div class="col">
              <div class="u-wrapper">
                <div class="u-wrapper-text u-border">
                  <router-link to="/my_posts">
                    <p>投稿</p>
                  </router-link>
                </div>
              </div>
            </div>
          </ul>
        </div>
      </div>

    　<router-view name="my_profile"></router-view>
      <router-view name="my_friends"></router-view>
      <router-view name="friend_reviews"></router-view>
      <router-view name="my_posts"></router-view>

    </main>
    `
  }

</script>

<style lang="scss" scoped>

.u-Sticky {
  position: -webkit-sticky; /* safari用 */
  position: sticky;
  z-index: 1;
  top: 0;
}

.u-wrapper:hover {
  cursor: pointer;
}
.col:hover > .u-wrapper > .u-wrapper-text.u-border {
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