<script>
const usr = new URLSearchParams();

export default {
  props: {
    btn_text: String,
    button_obj: Object,
    search_query: "",
  },
  data: function () { return {
    page_pattern: this.$store.getters['page_displaying/getPattern_Vuex'],
    friends: {},
    formData: new FormData(),
    axios_config: {},
  }},

  computed: {
    //DBに渡すための値
    array_query: function () {
      return this.search_query.split(" ");
    }
  },
  
  methods: {
    //検索
    search_for: function () {
      //一旦　全検索

      //this.$http.post('/api/ctrl_search_for_friends', {
      this.$http.post('/api/ctrl_all_users', {
        //search_query: this.array_query,
        user_id: this.$store.getters['auth_displaying/getMy_Data_Vuex'].id
      })
      .then(res => {

        if (res.data.result_flag === false) {
          alert("通信成功しましたが、該当データ見当たらないです。");
          return;
        }

        this.change_Page_Pattern('settings_result');
        console.log("検索成功");
        this.json_data = res.data;
        console.log("users: " + JSON.stringify(this.json_data.friends));
        console.log("result_flag : " + this.json_data.result_flag);

        //検索キーワード(search_query)と検索結果が欲しい
        //this.json_data = res.data;
        //vuexにフレンド情報を保存　
        this.$store.dispatch('user_info/friends', this.json_data.friends);


        this.$router.push({ name: 'search_result', params: { query: this.search_query }})
      })
      .catch(err => console.log(err))
      .finally(() => {
        console.log('finally')
      });

    },

    //プロフィール編集
    set_prof: function () {
      this.upload();
      alert(1);
      this.$http.post('/api/ctrl_set_prof', this.formData, this.axios_config)
      .then(res => {

        if (res.data.result_flag === false) {
          alert("通信成功しましたが、該当データ見当たらないです。");
          return;
        }
        console.log("プロフィール更新成功");
        this.change_Page_Pattern('settings');
        this.json_data = res.data;
        console.log(this.json_data);

        //vuexとwindow ユーザー情報を更新
        this.$store.dispatch('auth_displaying/set_my_data', this.json_data.my_data);
        window.Laravel.my_data = this.json_data.my_data;

        this.$router.push('/settings');
      })
      .catch(err => console.log(err))
      .finally(() => {
        console.log('finally')
      });

    },

    upload: function() {
      // FormData を利用して File を POST する
      this.formData.append('user_id', this.$store.getters['auth_displaying/getMy_Data_Vuex'].id);
      this.formData.append('prof_data', this.button_obj);

      this.axios_config = {
          headers: {
              'content-type': 'multipart/form-data'
          }
      };
    },
    //パスワード変更
    change_Pass: function () {
      
      this.$http.post('/api/ctrl_change_pass', {
        pass_now: this.button_obj.pass_now,
        pass_new: this.button_obj.pass_new,
        user_id: this.$store.getters['auth_displaying/getMy_Data_Vuex'].id,
      })
      .then(res => {
        console.log('通信成功');

        if (res.data.result_flag === false) {
          alert("通信成功しましたが、該当データ見当たらないです。");
          return;
        }

        console.log("PASS変更成功");
        this.json_data = res.data;
        this.change_Page_Pattern('settings');
        this.$router.push('/settings');
      })
      .catch(err => console.log(err))
      .finally(() => {
        console.log('finally')
      });

    }

    //サインアウト

    //退会処理
  },
  template: `

  <div>

      <!--検索-->
      <div v-if="page_pattern==='search'">
        <button @click.capture="search_for" type="button" class="btn w-100 bg-main u-mt-100 position-relative text-light">
          <img class="pr-1" src="/images/search-icon-white.png" style="display: inline-block; vertical-align: sub;" alt="">
          {{ btn_text }}
        </button>
      </div>

      <!--プロフィール編集-->
      <div v-else-if="page_pattern==='set_Prof'">
        <button　@click.capture="set_prof" type="button" class="btn w-100 bg-main mt-5 position-relative text-light">
            <img class="pr-1" src="/images/search-icon-white.png" style="display: inline-block; vertical-align: sub;" alt="">
            {{ btn_text }}   
        </button>
      </div>

      <!--パスワード変更-->
      <div v-else-if="page_pattern==='set_Pass'"> 
        <button @click.capture="change_Pass" type="button" class="btn w-100 bg-main mt-5 position-relative text-light">
          <img class="pr-1" src="/images/search-icon-white.png" style="display: inline-block; vertical-align: sub;" alt="">
          {{ btn_text }}
        </button>
      </div>
  </div>
  `
}
</script>