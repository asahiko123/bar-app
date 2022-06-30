import Vue from "vue";
import VueRouter from "vue-router";

import BarMap from "@/components/BarMap.vue";
import Home from "@/components/Home.vue";
import AboutUs from "@/components/AboutUs.vue";
import Login from "@/components/auth/Login.vue";
import Register from "@/components/auth/Register.vue";
import SystemErr from "@/pages/errors/System.vue";

Vue.use(VueRouter);

const routes = [
    {
        path: "/barMap",
        name: "barMap",
        component: BarMap,
    },
    {
        path: "/",
        name: "home",
        component: Home,
    },
    {
        path: "/aboutUs",
        name: "aboutUs",
        component: AboutUs,
    },
    {
        path: "/login",
        name: "login",
        component: Login,
    },
    {
        path: "/register",
        name: "register",
        component: Register,
    },
    {
        path: "500",
        component: SystemErr,
    },
];

export default new VueRouter({
    mode: "history",
    routes,
});
