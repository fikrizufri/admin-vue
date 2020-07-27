<template>
  <div class="wrapper">
    <app-loading />
    <app-header v-if="isAuth" />
    <app-navbar v-if="isAuth" />

    <div v-bind:class="{ 'content-wrapper': isAuth,'login-page': !isAuth }">
      <router-view></router-view>
    </div>
    <app-footer v-if="isAuth" />
  </div>
</template>
<script>
import { mapState, mapGetters } from "vuex";
import Header from "../components/Sidebar.vue";
import Navbar from "../components/Navbar.vue";
import Footer from "../components/Footer.vue";

import Loading from "../components/Loading.vue";

export default {
  computed: {
    ...mapState(["token"]),
    ...mapGetters(["isAuth"]),
  },
  components: {
    "app-navbar": Navbar,
    "app-header": Header,
    "app-footer": Footer,
    "app-loading": Loading,
  },
};
</script>