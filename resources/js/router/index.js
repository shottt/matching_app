import Vue from 'vue'
import VueRouter from 'vue-router'
Vue.use(VueRouter)


// 2.
import top from './projects/top/top.vue';
import home from './projects/home.vue';
import search from './projects/search/search.vue';
import settings from './projects/setting/settings.vue'
import change_pass from './projects/setting/change_pass.vue'

import footer from './components/footer.vue';
import header from './components/header.vue';
import header_search from './components/header_search.vue';
import header_search_result from './components/header_search_result.vue';
import header_settings from './components/header_setting.vue';
//import search_icon from './components/search_icon.vue';




// 3.


// 4.
const routes = [
    {
        path: '/',
        components: {
            c_main: top
        },
        /*
        children: [
           {
            path: "",  components: {
                content: main_content,
                button: button_
            } 
           }
        ]*/
    },
    {
        path: '/home',
        components: {
            c_header: header, 
            c_main: home, 
            c_footer: footer
        }
    },
    {
        path: '/search',
        components: {
            c_header: header_search, 
            c_main: search, 
            c_footer: footer
        },

    },
    {
        path: '/search_result/:query', name: "search_result",
        components: {
            c_header: header_search_result, 
            //c_main: search, 
            c_footer: footer
        },

    },
    {
        path: '/settings', name: "settings",
        components: {
            c_header: header_settings, 
            c_main: settings, 
            c_footer: footer
        },

    },
    {
        path: '/set_Prof',
        components: {
            c_header: header_settings, 
            c_main: settings, 
            c_footer: footer
        },

    },
    {
        path: '/set_Pass',
        components: {
            c_header: header_settings, 
            c_main: change_pass, 
            c_footer: footer
        },

    },
    {
        path: '/set_Sign_out',
        components: {
            c_header: header_settings, 
            c_main: settings, 
            c_footer: footer
        },

    },
    {
        path: '/set_Unsub',
        components: {
            c_header: header_settings, 
            c_main: settings, 
            c_footer: footer
        },

    },
    {
        path: '/change_pass', name: 'change_pass',
        components: {
            c_header: header_settings, 
            c_main: settings, 
            c_footer: footer
        },

    },

];

// 5.
const router = new VueRouter({

    mode: 'history',
    routes
})

// 6.
export default router