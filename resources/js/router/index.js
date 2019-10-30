import Vue from 'vue'
import VueRouter from 'vue-router'
Vue.use(VueRouter)


// 2.
import top from './projects/top/top.vue';
import home from './projects/home.vue';
import search from './projects/search/search.vue';

import footer from './components/footer.vue';
import header from './components/header.vue';

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
            c_header: header, 
            c_main: search, 
            c_footer: footer
        }
    }
];

// 5.
const router = new VueRouter({

    mode: 'history',
    routes
})

// 6.
export default router