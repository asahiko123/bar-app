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
            <v-container class="image_info">
                <v-row class="d-flex align-end flex-column">
                    <v-btn
                        class="card-action favorite"
                    >
                    <v-icon>mdi-cards-heart-outline</v-icon>
                    </v-btn>
                </v-row>

                <v-row class="d-flex align-start flex-column mt-auto">
                    <v-card-title>{{ item.user.account_name}}</v-card-title>
                </v-row>

            </v-container>

            
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