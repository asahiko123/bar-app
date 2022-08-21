<template>
    <div class="card-list">
        <div class="grid">
            <CardItem
                class="grid__item d-flex justify-center"
                v-for="item in list"
                :key="item.index"
                :item="item"
                >
            </CardItem>

            <!-- <div class="d-flex justify-center">
                <ul>
                <li v-for="item in list" :key="item.index">
                    <p>{{ item.user.account_name }}</p>
                    <img
                        :src="`/storage/${item.posted_image}`"
                        height="400"
                        width="500"
                        class="mb-4"
                    >
                </li>
                </ul>
            </div> -->
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
           
        //    const data = await this.fetchCards($state)
            
        //         if(!data){
        //             $state.error()
        //         }else if(data.length){
        //             this.list.push(...data)
        //             $state.loaded()
        //         }else if(data.length === 0){
        //             $state.complete()
        //         }

       },

    //    async fetchCards($state){

        // axios.get('/api/cards/index',{
        //     params: {
        //         page: this.page,
        //         per_page: 1
        //     },
        // }).then(({ data }) => {
        //     console.log({ data })
        //     setTimeout(() => {
        //         if(this.page < data.data.length){
        //             this.page += 1
        //             this.list.push(...data.data)
        //             console.log('読み込み')
        //             $state.loaded()
        //         }else{
        //             console.log('終了')
        //             $state.complete()
        //         }
        //     },1500)
        // }).catch(() => {
        //     console.log('終了')
        //     $state.complete()
        // })

        // await this.sleep(1500);
        // await axios.get('/api/cards/index').then((res) => {

        //     console.log(res.data.data)

        //     let cards =[]

            // if(res.status !== OK){
            //     this.$store.commit('error/setCode',res.status);
            //     return false;
            // }

            // cards.push(res.data.data)

            // console.log(cards);

            // // this.totalCount = res.data.total

            // return cards

            // let data = []
            // let num = this.list.length
            // if (num < 200) { // 最大200件まで
            //     for (let i = 1; i <= 20; i++) {
            //     data.push({ id: num + i , title: `記事タイトル${num + i}` })
            //     }
            // }
            // return data

            
        },

    //    sleep(time){
    //         return new Promise(resolve => {
    //             setTimeout(() => {
    //                 resolve()
    //             },time)
    //         })
    //    }
       
    
    // watch: {
    //     $route: {
    //         async handler(){
    //             await this.fetchCards()
    //         },
    //         immediate: true
    //     }
    // }
}
</script>