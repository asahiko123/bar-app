<template>
    <div class="card-list">
        <div class="grid">
            <CardItem
                class="grid__item d-flex justify-center"
                v-for="card in cards"
                :key="card.id"
                :item="card">
            </CardItem>

            <infinite-loading @infinite="infiniteHandler">
                <span slot="no-more">これ以上データはありません</span>
                <span slot="no-results">検索結果はありません</span>
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
            cards:[]
        }
    },
    methods:{

       async fetchCards(){

        await axios.get('/api/cards/index').then((res) => {

            console.log(res.data.data)

            if(res.status !== OK){
                this.$store.commit('error/setCode',res.status);
                return false;
            }

            this.cards = res.data.data

            this.totalCount = res.data.total

            
        })
       },
       infiniteHandler($state){
            if(this.totalCount <= this.cards.length > 100){
                $state.complete()
            }else{
                this.fetchCards()
                $state.loaded()
            }
       }
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