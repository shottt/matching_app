import Vue from 'vue'
import VueRouter from 'vue-router'
Vue.use(VueRouter)


// 2.
import top from './projects/top/top.vue';
import button_ from "./projects/top/button-sign-register.vue";
import main_content from "./projects/top/sign-register.vue";


import header from './components/header.vue';
import home from './projects/home.vue';


// 3.


// 4.
const routes = [
    {
        path: '/top',
        components: {
            c_header: header, c_main: top
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
            c_header: header, c_main: home
        }
    }
];
console.log(routes);
// 5.
const router = new VueRouter({

    mode: 'history',
    routes
})

// 6.
export default router