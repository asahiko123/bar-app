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
        
    }
</script>
