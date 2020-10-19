require('./bootstrap');
window.Vue = require('vue')

import common from './common'
Vue.mixin(common)

Vue.component('main-page', require('../components/MainPage.vue').default);

const app = new Vue({
    el: '#app',

  })