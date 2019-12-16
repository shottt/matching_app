
<script>
export default {
    props: {
    
      profile_header: String,
      profile_detail: String,
    },
    data: function() {
        return {
            pattern: "default",
            styles: {
                isActive_home: false,
                isActive_profile: false,
                isActive_friends: false,
                isActive_settings: false,
                isActive_post: false,
            }
        }
    },

    mounted: function () {
        this.$store.dispatch('auth_displaying/set_my_data', window.Laravel.my_data);
        
    },

    computed: {
        com_pattern: function () {  
            this.pattern = this.$store.getters['page_displaying/getPattern_Vuex'];
            return this.pattern;
        },

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
                this.$store.dispatch('user_info/friends', res.data.friends);
                
                this.$router.push('/friends');

            })
            .catch(err => console.log(err))
            .finally(() => {
                console.log('finally')
            });

        },
        reset_Styles: function () {
            this.styles.isActive_home = false;
            this.styles.isActive_profile = false;
            this.styles.isActive_friends = false;
            this.styles.isActive_settings = false;
             this.styles.isActive_post = false;
        },
        activate_Icon: function (){
            
            switch (this.com_pattern) {
                case "home":
                    this.reset_Styles();
                    this.styles.isActive_home = true;
                    this.$router.push("/home");
                    break;
                case "my_profile":
                    this.reset_Styles();
                    this.styles.isActive_profile = true;
                    this.$router.push("/my_profile");
                    break;
                case "friends":
                    this.reset_Styles();
                    this.styles.isActive_friends = true;
                    //pushは不要、show_Friends()から飛ぶので
                    break;
                case "settings":
                    this.reset_Styles();
                    this.styles.isActive_settings = true;
                    this.$router.push("/settings");
                    break;
                case "post":
                    this.reset_Styles();
                    this.styles.isActive_post = true;
                    this.$router.push("/post");
                    break;
                default: {
                    this.reset_Styles();
                    this.styles.isActive_home = true;
                    this.change_Page_Pattern('home');
                    this.$router.push("/home");
                    break;
                }
            }
        },


    },
    template: `
    <footer class="c-Footer u-top-border-grey container">
        <ul class="nav">

            <li class="nav-item col" @click.capture="change_Page_Pattern('home')">
                <a @click.capture="activate_Icon()" class="nav-link active">
                <i v-bind:class="{is_Acitve: styles.isActive_home,}" class="fas fa-home is_NoAcitve"></i>
                </a>
            </li>

            <li class="nav-item col" @click.capture="change_Page_Pattern('my_profile')">
                <a @click.capture="activate_Icon()" class="nav-link active">
                    <i v-bind:class="{is_Acitve: styles.isActive_profile,}" class="fas fa-user-check is_NoAcitve"></i>
                </a>
            </li>

            <li class="nav-item col" @click.capture="change_Page_Pattern('friends')">
                <p @click.capture="activate_Icon()">
                    <a v-on:click.capture="show_Friends" class="nav-link">
                        <i v-bind:class="{is_Acitve: styles.isActive_friends,}" class="fas fa-user-friends is_NoAcitve"></i>
                    </a>
                </p>
            </li>
            <li class="nav-item col" @click.capture="change_Page_Pattern('post')">
                <a @click.capture="activate_Icon()" class="nav-link active">
                    <i v-bind:class="{is_Acitve: styles.isActive_post,}" class="far fa-comment-alt is_NoAcitve"></i>
                </a>
            </li>
            <li class="nav-item col" @click.capture="change_Page_Pattern('settings')">
                <a @click.capture="activate_Icon()" class="nav-link active">
                    <i v-bind:class="{is_Acitve: styles.isActive_settings,}" class="fas fa-cog is_NoAcitve"></i>
                </a>
            </li>
        </ul>
    </footer>
    `
}

</script>
<style lang="scss" scoped>
.nav {
    width:100%;
}
i:before {
font-size: 24px;
}
.is_NoAcitve:before {
    color:#BCC5D3;
}

i:hover {
    &:before {
        color:#F271A8;
    }
}
.is_Acitve:before {
    color:#F271A8;
}

li {
    padding-left: 5px;
    padding-right: 5px;
}
</style>

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
  
