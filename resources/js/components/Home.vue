<template>
    <v-main>
        <v-container fluid>
            <v-row class="d-flex justify-center" v-for="tweet in tweets" :key="tweet.id">
                <v-col class="d-flex flex-row-reverse" >
                    <v-card>
                    <v-img
                    :src="tweet.img"
                    max-height="250"
                    max-width="250"
                    class="mb-4">
                    </v-img>
                    @{{tweet.content}}
                    </v-card>
                </v-col>
                <v-col class="d-flex flex-row">
                    <v-card>
                    <v-img
                    :src="tweet.subimg"
                    max-height="250"
                    max-width="250"
                    class="mb-4"
                    >
                    </v-img>
                    @{{tweet.subcontent}}
                    </v-card>
                </v-col>
            </v-row>
        </v-container>
    </v-main>
</template>

<script>
    export default {
        name: 'Home',
        data() {

        return{

            drawer: false,

            tweets: [
                {id: 1,img: "http://placehold.jp/150x150.png", content: "aaaa",subimg: "http://placehold.jp/150x150.png",subcontent: "aaaasub"},
                {id: 2,img: "http://placehold.jp/150x150.png", content: "bbbb",subimg: "http://placehold.jp/150x150.png",subcontent: "bbbbsub"},
                {id: 3,img: "http://placehold.jp/150x150.png", content: "cccc",subimg: "http://placehold.jp/150x150.png",subcontent: "ccccsub"},
                {id: 4,img: "http://placehold.jp/150x150.png", content: "dddd",subimg: "http://placehold.jp/150x150.png",subcontent: "ddddsub"},
                {id: 5,img: "http://placehold.jp/150x150.png", content: "4444",subimg: "http://placehold.jp/150x150.png",subcontent: "eeeesub"},

            ],

        }

        }

    }
</script>
