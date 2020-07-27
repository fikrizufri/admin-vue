import Vue from "vue";
import VueRouter from "vue-router";
import store from "./store.js";
import Dashboard from "./views/Dashboard.vue";
import Login from "./views/Login.vue";
import Category from "./views/Category.vue";

Vue.use(VueRouter);

const routes = [
    {
        path: "/",
        name: "dashboard",
        component: Dashboard,
        meta: {
            requiresAuth: true
        }
    },
    {
        path: "/login",
        name: "login",
        component: Login
    },
    {
        path: "/category",
        name: "category",
        component: Category,
        meta: {
            requiresAuth: true
        }
    }
];

const router = new VueRouter({
    mode: "history",
    base: process.env.BASE_URL,
    routes,
    linkActiveClass: "active"
});

//Navigation Guards
router.beforeEach((to, from, next) => {
    store.commit("CLEAR_ERRORS"); //clear errors
    store.commit("SET_LOADING", true); //clear errors
    if (to.matched.some(record => record.meta.requiresAuth)) {
        let auth = store.getters.isAuth;
        document.body.classList.remove("login-page");
        console.log();
        if (!auth) {
            setTimeout(() => {
                next({
                    name: "login"
                });
            }, 100);
        } else {
            setTimeout(() => {
                next();
            }, 100);
        }
    } else {
        setTimeout(() => {
            next();
        }, 100);
    }
});

router.afterEach(() => {
    store.commit("SET_LOADING", false);
});
export default router;
