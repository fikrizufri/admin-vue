<template>
    <div class="wrapper">
        <Navbar />
        <Sidebar />
        <Content />

        <Footer />
    </div>
</template>
<script>
import Navbar from "../components/Navbar";
import Sidebar from "../components/Sidebar";
import Sidebar from "../components/Content";
import Footer from "../components/Footer";
export default {
    components: { Navbar, Footer, Sidebar, Content },
    mounted() {
        window.$("body").Layout();
        window.$('[data-widget="pushmenu"]').PushMenu();
        window.$('[data-widget="control-sidebar"]').ControlSidebar();
        window.$('ul[data-widget="treeview"]').Treeview("init");
        window.$(".dropdown").Dropdown();
        window.$('ul[data-widget="treeview"]').overlayScrollbars();
    }
};
</script>
