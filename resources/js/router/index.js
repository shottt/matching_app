import Vue from 'vue'
import VueRouter from 'vue-router'

// 2.
import sign_register from './components/sign-register.vue'
import button_sign_register from './components/button-sign-register.vue'

// 3.
Vue.use(VueRouter)

// 4.
const routes = [
  {
    path: '/test',
    component: button_sign_register
  },

]

// 5.
const router = new VueRouter({
    mode: 'history',
    routes
})

// 6.
export default router