import './bootstrap'
import Vue from 'vue'
import App from './layouts/App.vue'
import router from './router'
import store from './store'

import BootstrapVue from 'bootstrap-vue';
import FlashMessage from '@smartweb/vue-flash-message';

Vue.use(BootstrapVue);
Vue.use(FlashMessage);

new Vue({
    el: '#app',
    router,
    store,
    render: h => h(App)
})
