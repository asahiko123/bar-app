/*
ログイン、ログアウト情報以外で複数コンポーネントをまたいでデータを共有するモジュール
*/


const state = {

    barName: null,
    dialog: false,
}

const getters = {

    getDialog(state){
        return state.dialog;
    }

}


const mutations = {

    setBarName(state,barName){
        state.barName = barName;
    },
    setDialog(state,dialog){
        state.dialog = dialog;
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