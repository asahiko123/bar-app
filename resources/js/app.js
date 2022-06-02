import Vue from 'vue'
import vuetify from '../plugins/vuetify'
import '@mdi/font/css/materialdesignicons.css'

import ExampleComponent from "./components/ExampleComponent"

new Vue({
    el: '#app',
    vuetify,
    data: {

        drawer: false,

        tweets: [
            {id: 1,img: "http://placehold.jp/150x150.png", content: "aaaa"},
            {id: 2,img: "http://placehold.jp/150x150.png", content: "bbbb"},
            {id: 3,img: "http://placehold.jp/150x150.png", content: "cccc"},
            {id: 4,img: "http://placehold.jp/150x150.png", content: "dddd"},
            {id: 5,img: "http://placehold.jp/150x150.png", content: "4444"},

        ],
        menus: [
        {title: 'Index', icon: 'mdi-web' ,url: '/'},
        {title: 'Home' , icon: 'mdi-home',url: '/home'}
        ],

        components: {
            ExampleComponent,
        }
    }
})
