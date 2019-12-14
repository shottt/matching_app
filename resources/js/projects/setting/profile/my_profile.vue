<script>
  export default {
    props: {
      //profile_header: String,
      //profile_detail: String,
    },
    data: function () {return{
      profile_header__displayed: "",
      profile_detail__displayed: "",
      profile_header: "",
      profile_detail: "",
      profile_header_flg: false,
      profile_detail_flg: false,

    }},
    mounted: function() {
     
      this.$nextTick(function () {
        // ビュー全体がレンダリングされた後にのみ実行されるコード
        //なにこれ　なんのため？なんか意味があった気がする
        this.pattern_data = this.$store.getters['page_displaying/getPattern_Vuex'];
        this.profile_header__displayed = this.$store.getters['auth_displaying/getMy_Data_Vuex'].profile_header;
        this.profile_detail__displayed = this.$store.getters['auth_displaying/getMy_Data_Vuex'].profile_detail;
          
      })
    },
    methods: {
      display_Input: function (text) {
        //どのinputかふるい分け
        //inputが非表示なら表示させる
        //ポインター使えたら、もっと簡単にできる。。。 JSでも*pみたいな感じで間接参照できたらいいのに

        if (text ==="profile_header" ) {

          if (this.profile_header_flg === false ) {
            this.profile_header_flg　= true;
          } else {
             this.profile_header_flg　= false;
          }
          
        } else if (text == "profile_detail" ) {
            if (this.profile_detail_flg === false) {
              this.profile_detail_flg = true;
          } else {
             this.profile_detail_flg = false;
          }
        }
      },

      set_Input: function (text) {
        let my_data = {};
        if (text ==="profile_header" ) {
          this.my_data['profile_header'] = this.profile_header;
        } else if (text === "profile_detail") {
          this.my_data['profile_detail'] = this.profile_detail;
        }
        
        this.$http.post('/api/ctrl_set_prof', {
          "my_data": this.my_data,
        })
        .then(res => {
          if (res.data.result_flag === false) {
          alert("通信成功しましたが、該当データ見当たらないです。");
          return;
        }
          
          console.log("プロフィール更新成功");
          this.json_data = res.data;
          console.log(this.json_data);
          })
          .catch(err => console.log(err))
          .finally(() => {
            console.log('finally');
        });
      
      },
    },
    template: `
    <section class="container profile-Detail text-left">
      <h1 class="profile-Detail__head u-txt-b pt-4 u-rel">{{ profile_header__displayed }}
      <i @click="display_Input('profile_header')" class="fas fa-pencil-alt u-text-orange u-abs-rb lead" data-toggle="modal" data-target="#modal_txt""></i>
      </h1>
      
      <div v-if="profile_header_flg===true" class="input-group mt-2 mb-3">
        <input v-model="profile_header" type="text" class="form-control w-100" placeholder="..." aria-label="..." aria-describedby="button-addon4">
        <div class="input-group-append mt-2" id="button-addon4">
          <button @click="display_Input('profile_header')" type="button" class="btn btn-outline-secondary">変更中止</button>
          <button @click="set_Input('profile_header')" type="button" class="btn btn-outline-secondary">変更する</button>
        </div>
      </div>

      <p class="profile-Detail__text pt-3 u-rel">
      {{ profile_detail__displayed }}
      <i @click="display_Input('profile_detail')" class="fas fa-pencil-alt u-text-orange u-abs-rb lead" data-toggle="modal" data-target="#modal_txt""></i>
      </p>
      <div v-if="profile_detail_flg===true" class="input-group mt-2">
        <textarea class="form-control w-100" aria-label="テキストエリア付き" aria-describedby="basic-textarea"></textarea>
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
}
.profile-Detail__text {
  color: #343a40;
}

i:hover {
  cursor: pointer;
}

</style>