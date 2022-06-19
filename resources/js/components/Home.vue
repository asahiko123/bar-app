<template>
    <v-main>
        <v-container fluid>
            <v-snackbar v-model = "snackbar" :timeout = "timeout">
                    {{ text }}
            </v-snackbar>
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
    import Message from "@/components/Message.vue";

    export default {
        name: 'Home',

        components: {
            Message,
        },

        data() {

            return{

                drawer: false,
                snackbar: false,
                text: null,
                timeout: 5000,

                tweets: [
                    {id: 1,img: "http://placehold.jp/150x150.png", content: "aaaa",subimg: "http://placehold.jp/150x150.png",subcontent: "aaaasub"},
                    {id: 2,img: "http://placehold.jp/150x150.png", content: "bbbb",subimg: "http://placehold.jp/150x150.png",subcontent: "bbbbsub"},
                    {id: 3,img: "http://placehold.jp/150x150.png", content: "cccc",subimg: "http://placehold.jp/150x150.png",subcontent: "ccccsub"},
                    {id: 4,img: "http://placehold.jp/150x150.png", content: "dddd",subimg: "http://placehold.jp/150x150.png",subcontent: "ddddsub"},
                    {id: 5,img: "http://placehold.jp/150x150.png", content: "4444",subimg: "http://placehold.jp/150x150.png",subcontent: "eeeesub"},

                ],
                methods: {

                    close(){
                        this.message = null;
                        this.errors = null;
                    },
            
                }

            }

        },
        mounted: function(){
            console.log(this.$route.params.message);
            this.snackbar = true;
            this.text = this.$route.params.message;
        },

    }
</script>
