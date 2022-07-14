<template>
    <div class="card-list">
        <div class="grid">
            <CardItem
                class="grid__item d-flex justify-center"
                v-for="item in list"
                :key="`list${item.id}`"
                >
            </CardItem>
            <infinite-loading @infinite="infiniteHandler">
                    <span slot="no-more">これ以上データはありません</span>
                    <span slot="no-results">検索結果はありません</span>
                    <span slot="spinner">取得中...</span>
            </infinite-loading>
        </div>
    </div>
</template>

<script>
import { OK } from '../../util'
import CardItem from './CardItem.vue'
import axios from 'axios'
import InfiniteLoading from 'vue-infinite-loading';


export default{
    components: {
        CardItem,
        InfiniteLoading,
    },
    data(){
        return {
            list:[]
        }
    },
    methods:{
        async infiniteHandler($state){
            await this.fetchCards().then((res) => {

                console.log(res)
            
                if(!res){
                    $state.error()
                }else if(res.length){
                    this.list.push(res)
                    $state.loaded()
                }else if(res.length === 0){
                    $state.complete()
                }

            })
       },

       async fetchCards(){

        await axios.get('/api/cards/index').then((res) => {

            console.log(res.data.data)

            let cards =[]

            if(res.status !== OK){
                this.$store.commit('error/setCode',res.status);
                return false;
            }

            cards.push(res.data.data)

            console.log(cards);

            // this.totalCount = res.data.total

            return cards

            
        })
       },
       
    },
    watch: {
        $route: {
            async handler(){
                await this.fetchCards()
            },
            immediate: true
        }
    }
}
</script>