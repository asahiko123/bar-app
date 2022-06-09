import Vue from 'vue'
import vuetify from '../plugins/vuetify'
import router from './router'
import '@mdi/font/css/materialdesignicons.css'
import App from '../js/components/App.vue'


new Vue({
    el: '#app',
    vuetify,
    router,
    render: h => h(App),
    data: {

        drawer: false,

        tweets: [
            {id: 1,img: "http://placehold.jp/150x150.png", content: "aaaa",subimg: "http://placehold.jp/150x150.png",subcontent: "aaaasub"},
            {id: 2,img: "http://placehold.jp/150x150.png", content: "bbbb",subimg: "http://placehold.jp/150x150.png",subcontent: "bbbbsub"},
            {id: 3,img: "http://placehold.jp/150x150.png", content: "cccc",subimg: "http://placehold.jp/150x150.png",subcontent: "ccccsub"},
            {id: 4,img: "http://placehold.jp/150x150.png", content: "dddd",subimg: "http://placehold.jp/150x150.png",subcontent: "ddddsub"},
            {id: 5,img: "http://placehold.jp/150x150.png", content: "4444",subimg: "http://placehold.jp/150x150.png",subcontent: "eeeesub"},

        ],
        menus: [
        {title: 'Index', icon: 'mdi-web' ,url: '/'},
        {title: 'Home' , icon: 'mdi-home',url: '/'}
        ],

        components: {
            Home,
        }
    }
    
})
