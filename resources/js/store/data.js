/*
ログイン、ログアウト情報以外で複数コンポーネントをまたいでデータを共有するモジュール
*/


const state = {

    barName: null,
}

const getters = {

}


const mutations = {

    setBarName(state,barName){
        state.barName = barName;
    }


}


const actions = {

    

}


export default {
    namespaced: true,
    state,
    getters,
    mutations,
    actions,

}