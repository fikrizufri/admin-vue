<template>
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown user-menu">
        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
          <img
            src="https://adminlte.io/themes/v3/dist/img/user2-160x160.jpg"
            class="user-image img-circle elevation-2"
            alt="User Image"
          />
          <span class="d-none d-md-inline">Alexander Pierce</span>
        </a>
        <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <!-- User image -->
          <li class="user-header bg-primary">
            <img
              src="https://adminlte.io/themes/v3/dist/img/user2-160x160.jpg"
              class="img-circle elevation-2"
              alt="User Image"
            />

            <p>Alexander Pierce - Web Developer</p>
          </li>
          <!-- Menu Body -->
          <li class="user-body">
            <div class="row">
              <div class="col-4 text-center">
                <a href="#">Followers</a>
              </div>
              <div class="col-4 text-center">
                <a href="#">Sales</a>
              </div>
              <div class="col-4 text-center">
                <a href="#">Friends</a>
              </div>
            </div>
            <!-- /.row -->
          </li>
          <!-- Menu Footer-->
          <li class="user-footer">
            <a href="#" class="btn btn-default btn-flat">Profile</a>
            <a
              href="javascript:void(0)"
              @click="logout"
              class="btn btn-default btn-flat float-right"
            >Sign out</a>
          </li>
        </ul>
      </li>
    </ul>
  </nav>
</template>

<script>
import { mapState, mapActions } from "vuex";
import moment from "moment";
export default {
  methods: {
    logout() {
      return new Promise((resolve, reject) => {
        localStorage.removeItem("token");
        resolve();
      }).then(() => {
        this.$store.state.token = localStorage.getItem("token");
        this.$router.push("/login");
      });
    },
  },
};
</script>
