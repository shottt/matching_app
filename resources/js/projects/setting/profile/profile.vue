<script>

  export default {
    data: function() {
     return {
        pattern_data: "",
        name: "",
        occupation: "",
        location: "",
        name_flg: false,
        occupation_flg: false,
        location_flg: false,
        json_data: {},
        //プロフィールが更新されると更新内容が即反映されるようにしてます
        name__displayed: this.$store.getters['auth_displaying/getMy_Data_Vuex'].name,
        occupation__displayed: this.$store.getters['auth_displaying/getMy_Data_Vuex'].occupation,
        location__displayed: this.$store.getters['auth_displaying/getMy_Data_Vuex'].location,

        //画像処理
        picture: "",
        picture_flg: false,
        picture__displayed: "",//this.$store.getters['auth_displaying/getMy_Data_Vuex'].picture,
        fileInfo: '',
      }
    },

    created: function() {
     
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
          this.picture__displayed = "aa";
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

      //画像アップロード処理　未完成
      fileSelected: function(event) {
        this.fileInfo = event.target.files[0];
        //初期選択なし
        if (this.fileInfo === undefined && this.picture === "" ) {
          return;
        }
        //選び直しで選択なし
        if (this.fileInfo === undefined && this.picture !== "" ) {
          this.fileInfo = this.picture;
        }

        const reader = new FileReader();
        let preview_img = document.querySelector(".js-preview-img > img");
        
        reader.onload = function (event) {
          preview_img.src = event.target.result;
        }
        this.picture = this.fileInfo;
        reader.readAsDataURL(this.fileInfo);
      },

      fileUpload(){
        let formData = new FormData()
        formData.append("picture", this.fileInfo);
        console.log(formData);

        axios.post('/api/ctrl_set_prof_img', formData, {
            headers: { 'content-type': 'multipart/form-data'}
        })
        .then(res => {
          if (res.data.result_flag === false) {
            alert("通信成功しましたが、該当データ見当たらないです。");
            return;
          }
          console.log("プロフィール更新成功");
          this.json_data = res.data;
          console.log(this.json_data);
          
          // //window.laravel 更新
          // window.Laravel.my_data['picture'] = this.json_data.my_data['picture'];
          // //vuex 更新
          // this.$store.dispatch('auth_displaying/set_my_data', window.Laravel.my_data);
          //picture__displayed更新
          //this.picture__displayed = this.json_data.picture;

        }).catch(err => console.log(err)
        
        ).finally(() => {
            console.log('finally');
        });
      },

    },
    template: `
    <main class="text-center u-bg-w u-pb-180">
      <div class="c-Card-Hero">
        <p class="c-Card-Hero__img">
          <img class="w-100" src="/images/avator1.png" alt="">
        </p>
        <dl class="c-Card-Hero__detail text-center">
          <dt>
            <label class="c-Card-Hero__img-input u-text-pink p-2" for="image">
              <i @click.self="display_Input('picture')" class="fas fa-camera u-text-orange lead"></i>
              
              <div class="u-align-center" v-if="picture_flg===true">
                <input @change="fileSelected" enctype="multipart/form-data" class="text-dark mb-2" type="file" id="image" name="prf_img">
                <p>{{ picture["name"] }}</p>
                <div v-if="picture !==''" class="input-group-append preview_btns" id="button-addon4">
                  <button data-toggle="modal" data-target="#preview" type="button" class="btn btn-outline-secondary">プレビュー</button>
                  <button v-on:click="fileUpload" type="button" class="btn btn-outline-secondary">アップロード</button>
                </div>
              </div>

            </label>
            
          </dt>

          <dd class="modal fade" id="preview" tabindex="-1" role="dialog" aria-labelledby="previewLabel">
            <div class="modal-dialog modal-margin" role="document">
              <div class="modal-content w-75 u-mx-a p-4 text-center">
                <p class="js-preview-img">
                  <img class="w-100" alt="プレビュー：プロフィール画像">
                  <p v-if="picture == '' " class="u-txt-b">画像を選択してください</p>
                </p>
                <dl class="mt-3">
                  <dt id="exampleModalLabel" class="modal-title u-txt-b">画像を更新しますか？</dt>
                  <dd class="u-txt-b">Are you sure you wish to update your profile image?</dd>
                </dl>
                <div>
                  <a v-on:click.self="fileUpload"  class="u-txt-p p-3 u-bg-grey3 d-inline-block u-w-40" data-dismiss="modal">はい</a>
                  <a class="u-txt-grey p-3 u-bg-grey3 d-inline-block u-w-40" data-dismiss="modal">いいえ</a>
                </div>

              </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
          </dd><!-- /.modal -->
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
}
.c-Card-Hero__img {
  max-height: 50vh;
  margin-left:auto;
  margin-right:auto;

  img {
    object-fit: contain;
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
  /*
  position: absolute;
  bottom: 20%;
  right: 0;
  left: 0;
  margin-left: auto;
  margin-right: auto;
  display: inline-block;
  border-radius: 4px;*/
  color: #fff;
  cursor: pointer;
  input {
    //display: none;
  }
}
.preview_btns {
  > button {
    background: #fff;
    &:hover {
      background-color: #6c757d;
    }
  }
}
.input-group {
  background: none;
    button {
    background: #fff;
    &:hover {
      background-color: #6c757d;
    }
  }
}
input[type="file"] {
  width:120px;
}
.modal-dialog  {
  margin-top: 10vh;
}
</style>