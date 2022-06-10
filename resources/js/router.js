import Vue from 'vue'
import VueRouter from 'vue-router'

import BarMap from './components/BarMap.vue'
import Home from './components/Home.vue'
import AboutUs from './components/AboutUs.vue'


Vue.use(VueRouter);

export default new VueRouter({
    mode:'history',
    routes: [
        {
            path: '/barMap',
            name: 'barMap',
            component: BarMap,

        },
        {
            path: '/',
            name: 'home',
            component: Home,

        },{
            path: '/aboutUs',
            name: 'aboutUs',
            component: AboutUs,
        }

    ],

})
