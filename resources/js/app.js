import "./bootstrap";
import Vue from "vue";
import App from "./layouts/App.vue";
import router from "./router";
import store from "./store.js";

import BootstrapVue from "bootstrap-vue";
import FlashMessage from "@smartweb/vue-flash-message";

Vue.use(BootstrapVue);
Vue.use(FlashMessage);

import { mapActions, mapGetters, mapState } from "vuex";

new Vue({
    el: "#app",
    router,
    store,
    render: h => h(App),
    computed: {
        ...mapGetters(["isAuth"]),
        ...mapState(["token"]), //GET TOKEN
        ...mapState("user", {
            user_authenticated: state => state.authenticated //MENGAMBIL STATE USER YANG SEDANG LOGIN
        })
    }
});
