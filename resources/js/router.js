import Vue from 'vue'
import VueRouter from 'vue-router'

import BarMap from './components/BarMap.vue'
import Home from './components/Home.vue'


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
            
        }
        
    ],
    
})