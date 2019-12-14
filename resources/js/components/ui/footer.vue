
<script>
export default {
    props: {
    
      profile_header: String,
      profile_detail: String,
    },
    data: function() {
        return {
            pattern: "default",
        }
    },

    mounted: function () {
        this.$store.dispatch('auth_displaying/set_my_data', window.Laravel.my_data);
        
    },

    methods: {
        edit_Prof__txt: function () {

        },
        edit_Prof__mage: function () {

        },
        
    },

    computed: {
        com_pattern: function () {  
            this.pattern = this.$store.getters['page_displaying/getPattern_Vuex'];
            return this.pattern;
        }
    },
    methods: {

        //友達一覧取得

        show_Friends: function () {
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

            this.change_Page_Pattern('friends');
            console.log("成功");

            //検索キーワード(search_query)と検索結果が欲しい
            //this.json_data = res.data;

            //仮の値を準備
            // res.data = {
            //       "friend1": { id: 1, picture: 11, name: 12,occupation: 13},
            //       "friend2": { id: 2, picture: 21, name: 22,occupation: 23},
            //       };
            //vuexにフレンド情報を保存　
            this.$store.dispatch('user_info/friends', res.data);
            
            this.$router.push('/friends');

        })
        .catch(err => console.log(err))
        .finally(() => {
            console.log('finally')
        });

        },
    },
    template: `
    <footer class="c-Footer u-top-border-grey container">
        <ul class="nav">

            <li class="nav-item col" @click.capture="change_Page_Pattern('home')">
            <router-link class="nav-link active" to='/home'>
                <img v-if="com_pattern ==='home'" src="/images/footer/home-icon--active.png" alt="アイコン：ホーム" class="img-fluid">
                <img v-if="com_pattern !=='home'" src="/images/footer/home-icon.png" alt="アイコン：ホーム" class="img-fluid">
            </router-link><br>
            </li>

            <li class="nav-item col" @click.capture="change_Page_Pattern('friends')">
            <p v-on:click.capture="show_Friends" class="nav-link">
                <img v-if="com_pattern ==='friend'" src="/images/footer/friends-icon--active.png" alt="アイコン：友達" class="img-fluid">
                <img v-if="com_pattern !=='friend'" src="/images/footer/friends-icon.png" alt="アイコン：友達" class="img-fluid">
            </p>
            </li>

            <li class="nav-item col" @click.capture="change_Page_Pattern('settings')">
            <router-link class="nav-link" to="/settings">
                <img v-if="com_pattern ==='settings'" src="/images/footer/settings-icon--active.png" alt="アイコン：設定" class="img-fluid">
                <img v-if="com_pattern !=='settings'" src="/images/footer/settings-icon.png" alt="アイコン：設定" class="img-fluid">
            </router-link>
            </li>
        </ul>
    </footer>
    `
}

</script>


       <!--
            <li class="nav-item col" @click.capture="change_Page_Pattern('friend')">
                <router-link class="nav-link" to="/friend">
                    <img src="/images/footer/friends-icon.png" alt="アイコン：友達" class="img-fluid">
                </router-link>
            </li>
         
              <li class="nav-item col">
                  <router-link class="nav-link" :to="{name: 'f_messages'}">
                      <img src="/images/footer/messages-icon.png" alt="" class="img-fluid">
                  </router-link>
              </li>
              <li class="nav-item col">
                  <router-link class="nav-link" :to="{name: 'f_settings'}">
                      <img src="/images/footer/settings-icon.png" alt="" class="img-fluid">
                  </router-link>
              </li>

              
              -->
  
