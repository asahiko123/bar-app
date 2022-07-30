import Vue from 'vue'
import Vuex from 'vuex'
import createPersistedState from 'vuex-persistedstate'
import auth from './auth'
import error from './error'

Vue.use(Vuex);


const store = new Vuex.Store({

    modules: {
        auth,
        error
    },

    plugins: [createPersistedState(
        {
            key: 'bar-app',
            storage: window.sessionStorage
            
        }
    )]
});
 


export default store