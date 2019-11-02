
<script>
import { mapGetters } from 'vuex';
export default {
    props: {
       
    },
    data: function() {
        return {
            pattern: "default",
        }
    },
    computed: {
        ...mapGetters([
        'auth_displaying/getDisplay_Vuex',
        'page_displaying/getPattern_Vuex'

        ]),
    },
    methods: {
        /*
        change_Page_Pattern: function () {
        console.log("change_Page_Pattern");
        this.$store.dispatch('page_displaying/pattern_search')
        }*/

        change_Page_Pattern: function (pattern) {
            console.log("change_Page_Pattern");
            this.pattern = this.$store.dispatch('page_displaying/pattern_' + pattern);
            //console.log(this.$store.getters['page_displaying/getPattern_Vuex']);
        }
    },
    template: `
    <footer class="c-Footer container">
        <ul class="nav">

            <li class="nav-item col" @click="change_Page_Pattern('home')">
                <router-link class="nav-link active" to='/home'>
                    <img src="/images/footer/home-icon--active.png" alt="" class="img-fluid">
                </router-link><br>
            </li>

            <li class="nav-item col">
                  <router-link class="nav-link" to="/">
                      <img src="/images/footer/frends-icon.png" alt="" class="img-fluid">
                  </router-link>
            </li>

            <li class="nav-item col" @click="change_Page_Pattern('settings')">
                <router-link class="nav-link" to="/settings">
                    <img src="/images/footer/settings-icon.png" alt="" class="img-fluid">
                </router-link>
            </li>
        </ul>
    </footer>
    `
}

</script>


       <!--
              <li class="nav-item col">
                  <router-link class="nav-link" to="/">
                      <img src="/images/footer/frends-icon.png" alt="" class="img-fluid">
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
  