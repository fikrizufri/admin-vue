<template>
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <router-link to="/" class="brand-link">
      <img
        src="https://adminlte.io/themes/v3/dist/img/AdminLTELogo.png"
        alt="Logo"
        class="brand-image elevation-3"
        style="opacity: .8"
      />
      <span class="brand-text font-weight-light">AdminLTE3</span>
    </router-link>
    <div class="sidebar">
      <nav class="mt-2">
        <ul
          class="nav nav-pills nav-sidebar flex-column"
          data-widget="treeview"
          role="menu"
          data-accordion="false"
        >
          <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
          <li class="nav-item">
            <router-link to="/" class="nav-link" exact>
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>Dashboard</p>
            </router-link>
          </li>

          <li class="nav-item">
            <router-link to="/category" class="nav-link" exact>
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>Catergory</p>
            </router-link>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
  </aside>
</template>
