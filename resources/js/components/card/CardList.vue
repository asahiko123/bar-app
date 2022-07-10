<template>
    <div class="card-list">
        <div class="grid">
            <CardItem
                class="grid__item"
                v-for="card in cards"
                :key="card.id"
                :item="card">
            </CardItem>
        </div>
    </div>
</template>

<script>
import { OK } from '../../util'
import CardItem from './CardItem.vue'
import axios from 'axios'


export default{
    components: {
        CardItem
    },
    data(){
        return {
            cards:[]
        }
    },
    methods:{

       async fetchCards(){

        await axios.get('/api/cards/index').then((res) => {

            console.log(res)

            if(res.status !== OK){
                this.$store.commit('error/setCode',res.status);
                return false;
            }

            this.cards = res.data.data
        })
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