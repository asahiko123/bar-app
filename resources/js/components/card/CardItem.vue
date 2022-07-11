<template>
    <v-card class="card">

        <Router-Link
            class="card-overlay"
            :to ="`/cards/${item.id}`"
        >
            <v-img 
                :src="item.url" 
                :alt="`${item.user.account_name}`" 
                width="500" height="400">
            <div class="card-wrapper">

                <v-row justify="end">
                    <v-card-actions>
                        <v-btn
                        class="card-action favorite"
                        >
                        <v-icon>mdi-cards-heart-outline</v-icon>
                        </v-btn>
                    </v-card-actions>

                </v-row>

                <v-row justify="start">
                    <v-card-title>{{ item.user.account_name}}</v-card-title>
                </v-row>
                
            </div>

            
            </v-img>
        </Router-Link>
    </v-card>
</template>

<script>

export default{
    props:{
        item:{
            type: Object,
            required: true,
        }
    }
}
</script>