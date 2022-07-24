import Vue from "vue";
import vuetify from "../plugins/vuetify";
import router from "./router";
import store from "./store";
import "@mdi/font/css/materialdesignicons.css";
import App from "./components/App.vue";
import * as VueGoogleMaps from "vue2-google-maps";
// import InfiniteLoading from 'vue-infinite-loading';
import "./bootstrap";

Vue.use(VueGoogleMaps, {
    load: {
        key: "AIzaSyDI3YFriHHFy59N8o-mItG7vn1LyVJT9go",
        libraries: "places",
    },
});

const createApp = async () => {
    await store.dispatch("auth/currentUser");

    new Vue({
        el: "#app",
        vuetify,
        router,
        store,
        render: (h) => h(App),
    });
};

createApp();
