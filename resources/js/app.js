

require('./bootstrap');

window.Vue = require('vue');

import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

Vue.component('myheader', require('./components/Myheader.vue').default);
Vue.component('myfooter', require('./components/Myfooter.vue').default);


let routes = [{
    path: '/home',
    component: require('./components/Home.vue').default
  },
  {
    path: '/about',
    component: require('./components/About.vue').default
  }
]
const router = new VueRouter({
    // mode:'history',
  routes // short for `routes: routes`
})


const app = new Vue({
    el: '#app',
    router
});
