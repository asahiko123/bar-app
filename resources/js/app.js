import Vue from 'vue'
import vuetify from '../plugins/vuetify'
import router from './router'
import '@mdi/font/css/materialdesignicons.css'
import App from './components/App.vue'
import *as VueGoogleMaps from 'vue2-google-maps'

Vue.use(VueGoogleMaps,{
    load: {
        key: 'YOUR_API_KEY',
        libraries: 'places',
    }
});


new Vue({
    el: '#app',
    vuetify,
    router,
    render: h => h(App),


})
