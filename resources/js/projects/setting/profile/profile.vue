<script>

  export default {
    data: function() {
     return {
        pattern_data: "",
        name: "",
        occupation: "",
        location: "",
        picture: "",
        name_flg: false,
        occupation_flg: false,
        location_flg: false,
        picture__flg: true,
        json_data: {},
        //プロフィールが更新されると更新内容が即反映されるようにしてます
        name__displayed: this.$store.getters['auth_displaying/getMy_Data_Vuex'].name,
        occupation__displayed: this.$store.getters['auth_displaying/getMy_Data_Vuex'].occupation,
        location__displayed: this.$store.getters['auth_displaying/getMy_Data_Vuex'].location,

        //画像処理
        picture__displayed: this.$store.getters['auth_displaying/getMy_Data_Vuex'].picture,
      }
    },

    mounted: function() {
     
        this.$nextTick(function () {
        // 子のコンポがレンダリングされた後にのみ実行されるコード
        //なにこれ　なんのため？ なんか意味があった気がする
        this.pattern_data = this.$store.getters['page_displaying/getPattern_Vuex'];
        
        this.name__displayed = this.$store.getters['auth_displaying/getMy_Data_Vuex'].name;
        if (this.name__displayed === "") {
          this.name__displayed = "お名前を教えてください。";
        }
        this.occupation__displayed = this.$store.getters['auth_displaying/getMy_Data_Vuex'].occupation;
        if (this.occupation__displayed === "") {
          this.occupation__displayed = "ご職業を教えてください。";
        }
        this.location__displayed = this.$store.getters['auth_displaying/getMy_Data_Vuex'].location;
        if (this.location__displayed === "") {
          this.location__displayed = "お住まいを教えてください。";
        }

        this.picture__displayed = this.$store.getters['auth_displaying/getMy_Data_Vuex'].picture;
        if (this.picture__displayed === "") {
          //デフォルトの画像を表示したい
          this.picture__displayed = "";
        }

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

      //インプットの表示非表示
      display_Input: function (text) {
        this.get_Prof_Type(this, text);
      },
      set_Input: function (text) {
        //app.jsに記載
        //jsonを投げてる
        this.json_data = this.update_Prof(this, text);
      },
      selectedFile: function(e) {
        // 選択された File の情報を保存しておく
        // e.preventDefault();
        // let files = e.target.files;
        // this.prof_data.picture = files[0];
        // this.prof_data.picture_name = files[0].name;
        alert(111);
        this.fileInfo = e.targetfiles[0];
      },
    },
    template: `
    <main class="text-center u-bg-w u-pb-180">
      <div class="c-Card-Hero">
        <img class="w-100" src="/images/avator1.png" alt="">
        <label class="c-Card-Hero__img-input u-text-pink p-2" for="image">
          <i class="fas fa-camera u-text-orange lead"></i>
          <input @change="selectedFile" mulitple="multiple" class="text-dark" type="file" id="image">
        </label>
        <dl class="c-Card-Hero__detail text-center">
          <dt>
          {{ name__displayed }}
          <i @click="display_Input('name')" class="pl-2 fas fa-pencil-alt u-text-orange lead"></i>
          </dt>
          <dd v-if="name_flg===true" class="input-group mt-2 mb-3">
            <input v-model="name" type="text" class="form-control" placeholder="お名前" aria-label="..." aria-describedby="button-addon4">
            <div class="input-group-append" id="button-addon4">
              <button @click="display_Input('name')" type="button" class="btn btn-outline-secondary">変更中止</button>
              <button @click="set_Input('name')" type="button" class="btn btn-outline-secondary">変更する</button>
            </div>
          </dd>

          <dd>
            <span class="u-opa-5">{{ occupation__displayed }}</span><i @click="display_Input('occupation')" class="fas fa-pencil-alt u-text-orange lead"></i>,
            <div v-if="occupation_flg===true" class="input-group mt-2 mb-3">
              <input v-model="occupation" type="text" class="form-control" placeholder="ご職業" aria-label="..." aria-describedby="button-addon4">
              <div class="input-group-append" id="button-addon4">
                <button @click="display_Input('occupation')" type="button" class="btn btn-outline-secondary">変更中止</button>
                <button @click="set_Input('occupation')" type="button" class="btn btn-outline-secondary">変更する</button>
              </div>
            </div>
            
            <span class="u-opa-5">{{ location__displayed }}</span><i @click="display_Input('location')" class="fas fa-pencil-alt u-text-orange lead"></i>
            <div v-if="location_flg===true" class="input-group mt-2 mb-3">
              <input v-model="location" type="text" class="form-control" placeholder="お住まい" aria-label="..." aria-describedby="button-addon4">
              <div class="input-group-append" id="button-addon4">
                <button @click="display_Input('location')" type="button" class="btn btn-outline-secondary">変更中止</button>
                <button @click="set_Input('location')" type="button" class="btn btn-outline-secondary">変更する</button>
              </div>
            </div>
          </dd>

        </dl>

        
      </div>

      <div class="u-Sticky">
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
.c-Card-Hero {
  overflow: hidden;
  > img {
    min-height: 400px;
    object-fit: cover;
  }
}
.u-Sticky {
  position: -webkit-sticky; /* safari用 */
  position: sticky;
  z-index: 1;
  top: 0;

  &:before {
    content: "";
    display: block;
    padding: 15px 0;
    background: linear-gradient(-135deg, #F271A8, #F5B062) fixed;
  }
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
.input-group {
  width: 80%;
  margin-left: auto;
  margin-right: auto;
  background: #fff;
}
i:hover {
  cursor: pointer;
}


.c-Card-Hero__img-input {
  position: absolute;
  bottom: 0;
  right: 0;
  display: inline-block;
  border-radius: 4px;
  box-shadow:  0 2px 6px rgba(146, 146, 146, 0.8);
  cursor: pointer;
  input {
    display: none;
  }
}
</style>