
/*
コンポーネントをまたいでエラーを扱うストアモジュール
エラーのステータスコードであるcodeステートを持っている
*/
const state = {

    code: null

}

const mutations = {

    setCode(state, code){
        state.code = code
    }
}


export default {
    namespaced: true,
    state,
    mutations
}