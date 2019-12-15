<script>
  export default {
    props: {
      //profile_header: String,
      //profile_detail: String,
    },
    data: function () {return{
      profile_header: "",
      profile_detail: "",
      profile_header_flg: false,
      profile_detail_flg: false,
      json_data: {},
      //プロフィールが更新されると更新内容が即反映されるようにしてます
      profile_header__displayed: this.$store.getters['auth_displaying/getMy_Data_Vuex'].profile_header,
      profile_detail__displayed: this.$store.getters['auth_displaying/getMy_Data_Vuex'].profile_detail,

    }},
    mounted: function() {
     
      this.$nextTick(function () {
        // ビュー全体がレンダリングされた後にのみ実行されるコード
        //なにこれ　なんのため？なんか意味があった気がする
        this.pattern_data = this.$store.getters['page_displaying/getPattern_Vuex'];
        this.profile_header__displayed = this.$store.getters['auth_displaying/getMy_Data_Vuex'].profile_header;
        if (this.profile_header__displayed === "") {
          this.profile_header__displayed = "あなたを一言で表すと？";
        }
        this.profile_detail__displayed = this.$store.getters['auth_displaying/getMy_Data_Vuex'].profile_detail;
        if (this.profile_detail__displayed === "") {
          this.profile_detail__displayed = "自己紹介をお願いします。";
        }
          
      })
    },
    computed: {

    },
    methods: {
      //インプットの表示非表示
      display_Input: function (text) {
        this.get_Prof_Type(this, text);
      },

      set_Input: function (text) {
        //app.jsに記載
        //jsonを投げてる
        this.json_data = this.update_Prof(this, text);
      },
    },
    template: `
    <section class="container profile-Detail text-left">
      <p class="profile-Detail__head u-txt-b pt-4 u-rel">{{ profile_header__displayed }}
      <i @click="display_Input('profile_header')" class="fas fa-pencil-alt u-text-orange u-abs-rb lead"></i>
      </p>
      
      <div v-if="profile_header_flg===true" class="input-group mt-2 mb-3">
        <input v-model="profile_header" type="text" class="form-control w-100" placeholder="..." aria-label="..." aria-describedby="button-addon4">
        <div class="input-group-append mt-2" id="button-addon4">
          <button @click="display_Input('profile_header')" type="button" class="btn btn-outline-secondary">変更中止</button>
          <button @click="set_Input('profile_header')" type="button" class="btn btn-outline-secondary">変更する</button>
        </div>
      </div>

      <p class="profile-Detail__text pt-3 u-rel">
      {{ profile_detail__displayed }}
      <i @click="display_Input('profile_detail')" class="fas fa-pencil-alt u-text-orange u-abs-rb lead"></i>
      </p>
      <div v-if="profile_detail_flg===true" class="input-group mt-2">
        <textarea v-model="profile_detail" class="form-control w-100" aria-label="テキストエリア付き" aria-describedby="basic-textarea"></textarea>
        <div class="input-group-prepend mt-2">
          <button @click="display_Input('profile_detail')" type="button" class="btn btn-outline-secondary">変更中止</button>
          <button @click="set_Input('profile_detail')" type="button" class="btn btn-outline-secondary">変更する</button>
        </div>
      </div>



    </section>



    `
  }

</script>

<style lang="scss" scoped>

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
  font-size: 24px;
}
.profile-Detail__text {
  color: #343a40;
}

i:hover {
  cursor: pointer;
}

</style>