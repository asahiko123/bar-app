
<template>
    <v-main>
        <v-app>
            <v-card
            class="mx-auto my-12"
            width="700"
            >
            <v-card-actions>
                <v-list-item class="w-100">
                    <v-avatar
                        color="grey-darken-3"
                        class="mr-5"
                    >
                        <img
                        src="https://cdn.vuetifyjs.com/images/john.jpg"
                        alt="John"
                        >
                    </v-avatar>
        
                    <v-list-item-title>{{ data.user.account_name }}</v-list-item-title>
                    <v-list-item-subtitle>Vue Creator</v-list-item-subtitle>

                </v-list-item>
            </v-card-actions>
            
            <template v-slot:loader="{ isActive }">
                <v-progress-linear
                :active="isActive"
                color="deep-purple"
                height="4"
                indeterminate
                ></v-progress-linear>
            </template>
        
            <v-img
                cover
                height="1200"
                :src="data.url"
            ></v-img>
        
            <v-card-item>
                <v-card-title>{{ data.menu }}</v-card-title>
        
                <v-card-subtitle>
                <span class="me-1">{{ data.bar }}</span>
        
                <v-icon
                    color="error"
                    icon="mdi-fire-circle"
                    size="small"
                ></v-icon>
                </v-card-subtitle>
            </v-card-item>
        
            <v-card-text>
                <v-row
                
                class="mx-0"
                >
                <v-rating
                    :model-value="4.5"
                    color="amber"
                    density="compact"
                    half-increments
                    readonly
                    size="small"
                ></v-rating>
        
                <div class="text-grey ms-4">
                    4.5 (413)
                </div>
                </v-row>
        
                <div class="my-4 text-subtitle-1">
                {{ data.price }} 円 Italian, Cafe
                </div>
        
                <div>{{ data.comment }}</div>
            </v-card-text>
        
            <v-divider class="mx-4 mb-1"></v-divider>
        
            <v-card-actions>
                <v-btn
                color="deep-purple-lighten-2"
                variant="text"
                @click="reserve"
                >
                Reserve
                </v-btn>
            </v-card-actions>
            </v-card>
        </v-app>
    </v-main>
</template>
<script>
import axios from 'axios';



export default{

    name: "cardsForm",

    data() {
        return {
            data: null
        };
    },

    mounted: async function(){
        const response = await axios.get(`/api/cards/${this.$route.params.id}`)
        console.log(response)
        this.data = response.data

        }


    
}
</script>

<style lang="scss">
    .card-container{
        height: 100%;
    }
</style>