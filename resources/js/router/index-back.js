import Vue from 'vue'
import VueRouter from 'vue-router'

// 2.
let header = require('./components/header.js');
let home = require('./projects/home.js');



// 4.
const routes = [
  { 
      path: '/home', name: 'f_home', 
      component: {
        c_header: header, c_main: home
      },
      
      props: {
        default: true, c_main: true
      },
      /*
      children: [
          { path: "", component: "",},
          { path: "", component: ""}
      ]*/
  }, 
  /*
  {
      path: '/frends:pattern', name: 'f_frends', component: frends,
      children: [
          { path: "", component: "",},
          { path: "", component: ""}
      ]
  },
  {
      path: '/messages:pattern', name: 'f_messages', component: messages,
      children: [
          { path: "", component: "",},
          { path: "", component: ""}
      ]
  },
  {
      path: '/settings:pattern', name: 'f_settings', component: settings,
      children: [
          { path: "", component: "",},
          { path: "", component: ""}
      ]
  }*/

];

// 5.
const router = new VueRouter({

    mode: 'history',
    routes
})

// 6.
export default router