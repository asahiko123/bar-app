import Vue from 'vue'
import vuetify from '../plugins/vuetify'
import router from './router'
import '@mdi/font/css/materialdesignicons.css'
import App from './components/App.vue'


new Vue({
    el: '#app',
    vuetify,
    router,
    render: h => h(App),


})
