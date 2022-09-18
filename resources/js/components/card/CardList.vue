<template>
    <div class="card-list">
        <div class="grid">
            <CardItem
                class="grid__item d-flex justify-center"
                v-for="item in list"
                :key="item.index"
                :item="item"
                @like="onLikeClick"
                >
            </CardItem>

            <infinite-loading spinner="spiral" @infinite="infiniteHandler">
                    <span slot="no-more">これ以上データはありません</span>
                    <span slot="no-results">検索結果はありません</span>
                    
            </infinite-loading>
        </div>
    </div>
</template>

<script>
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
            list:[],
            page: 1,
        }
    },
    methods:{
        async infiniteHandler($state){

                axios.get('/api/cards/index',{
                params: {
                    page: this.page,
                },
                }).then(({ data }) => {
                    console.log({ data })
                    setTimeout(() => {
                        if(this.page < data.data.length){
                            this.page += 1
                            console.log(this.page)
                            this.list.push(...data.data)
                            console.log(this.list);
                            console.log('読み込み')
                            $state.loaded()
                        }else{
                            console.log('終了')
                            $state.complete()
                        }
                    },1500)
                }).catch(() => {
                    console.log('終了')
                    $state.complete()
                })
        },

        onLikeClick({id,liked}){
            if(!this.$store.getters['auth/check']){
                alert('いいね機能はログインしてから使えます！');
                return false;
            }

            console.log(liked);

                if(liked){
                    this.unliked(id);
                }else{
                    this.liked(id);
                }
        },

        async liked(id){

            const response = await axios.put(`api/cards/${id}/like`);
            console.log(response);

            this.list = this.list.map((card)=>{
                if(card.id === response.data.cards_id){
                    card.likes_count += 1;
                    card.already_liked = true;

                }

                return card;
            })
            
        },

        async unliked(id){
            console.log('unliked');

            const response = await axios.delete(`/api/cards/${id}/unlike`);

            this.list = this.list.map((card)=>{
                if(card.id === response.data.cards_id){
                    card.likes_count -= 1;
                    card.already_liked = false;
                }

                return card;
            });
        }
        
    
    },
}
</script>