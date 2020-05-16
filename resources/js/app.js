/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

window.Vue = require('vue');

import VueRouter from 'vue-router'
import Vuex from 'vuex'

import store from './store'
import vuetify from '../plugins/vuetify'

Vue.use(VueRouter)
Vue.use(Vuex)

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */
Vue.component('layout', require('./components/Layout.vue').default);

import List from './pages/List'
import Import from './pages/Import'
import Detail from './pages/Detail'

const routes = [
  {
    path: '/contacts',
    component: List
  },
  {
    path: '/contacts/import',
    component: Import
  },
  {
    path: '/contacts/:id',
    component: Detail
  }
]

const router = new VueRouter({
  mode: "history",
  routes
})

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
  el: '#app',
  vuetify,
  router,
  store,
});
