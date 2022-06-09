import Vue from 'vue'
import VueRouter from 'vue-router'

import BarMap from './components/BarMap'
import Home from './components/ExampleComponent'


Vue.use(VueRouter);

export default new VueRouter({
    mode:'history',
    routes: [
        {
            path: '/barMap',
            name: 'BarMap',
            component: BarMap,

        },
        {
            path: '/',
            name: 'Home',
            component: Home,
        }
        
    ]
})