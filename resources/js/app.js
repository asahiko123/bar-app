import Vue from 'vue'
import vuetify from '../plugins/vuetify'
import router from './router'
import store from './store'
import '@mdi/font/css/materialdesignicons.css'
import App from './components/App.vue'
import *as VueGoogleMaps from 'vue2-google-maps'
import './bootstrap'


Vue.use(VueGoogleMaps,{

    load: {
        key: process.env.VUE_APP_GOOGLE_MAP_API,
        libraries: 'places',
    }
});

const createApp = async() => {

    await store.dispatch('auth/currentUser')


    new Vue({
        el: '#app',
        vuetify,
        router,
        store,
        render: h => h(App),
    
    
    })


}

createApp();
