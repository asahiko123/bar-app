import { OK, UNPROCESSABLE_ENTITY } from '../util'
import axios from 'axios';

/*
ログイン、ログアウト情報をコンポーネントをまたいで共有するストアモジュール
ログインユーザ名、エラーステートメントを持っている。
*/


const state = {

    user: null,
    apiStatus: null,
    loginErrorMessages: null,

}

const getters = {
    check: state => !!state.user,
    username: state => state.user ? state.user.account_name: ''
}

const mutations = {

    setUser(state, user){
        state.user = user
    },
    setApiStatus(state,status){
        state.apiStatus = status
    },
    setLoginErrorMessages(state,messages){
        state.loginErrorMessages = messages
    }
}

const actions = {

    async register(context ,data){
        const response = await axios.post('/api/register',data)
        context.commit('setUser', response.data)
    },
    async login(context, data){
        context.commit('setApiStatus',null)
        const response = await axios.post('/api/login',data)
        .catch(err => err.response || err)

        if(response.status == OK){
            context.commit('setApiStatus',true)
            context.commit('setUser',response.data)

            return false
        }

        context.commit('setApiStatus',false)

        if(response.status === UNPROCESSABLE_ENTITY){
            context.commit('setLoginErrorMessages',response.data.errors)
        }else{
            context.commit('error/setCode',response.status,{ root: true})
        }
        
    },
    async logout(context){
        context.commit('setApiStatus', null)
        const response = await axios.post('/api/logout')
    
        if (response.status === OK) {
          context.commit('setApiStatus', true)
          context.commit('setUser', null)
          return false
        }
    
        context.commit('setApiStatus', false)
        context.commit('error/setCode', response.status, { root: true })
    },
    async currentUser(context){
        context.commit('setApiStatus', null)
        await axios.get('/api/user').then((res) => {

            const user = res.data || null
            console.log(res)

            context.commit('setApiStatus', true)
            context.commit('setUser', user)
            return false

        }).catch((error) => {

            context.commit('setApiStatus', false)
            context.commit('error/setCode', error.response, { root: true })

        })

        
    },
}

export default {
    namespaced: true,
    state,
    getters,
    mutations,
    actions,
}