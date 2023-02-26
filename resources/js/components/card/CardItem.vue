<template>
    <div class="card">

        <Router-Link
            class="card-overlay d-flex justify-center"
            :to ="{path: `/cards/${item.id}`}"
        >
        {{ item }}
            <v-img 
                :src="item.url" 
                :alt="`${item.user.account_name}`" 
                width="563" height="563"
            >
            <div class="card-wrapper">

                <v-row justify="end">
                    <v-card-actions
                        >
                        <v-btn
                        icon
                        class="button button__like"
                        @click.prevent="favorite"
                        >
                        <v-card color="white">
                            <v-icon  :class="{ 'button__liked': item.already_liked }" >mdi-heart</v-icon>{{ item.likes_count }}
                        </v-card>
                            
                        <!-- <v-icon v-if="!item.already_liked" class="icon icon-md-heart" >mdi-heart</v-icon>{{ item.likes_count }} -->
                        </v-btn>
                    </v-card-actions>

                </v-row>

                <v-row justify="start" class="name">
                    <v-card color="transparent">
                        <v-card-title class="barName">{{ item.bar }}</v-card-title>
                    </v-card>
                </v-row>
                
            </div>
            </v-img>
        </Router-Link>
    </div>
</template>


<script>

export default{
    props:{
        item:{
            type: Object,
            required: true,
        }
    },
    
    methods:{
        favorite(){
            console.log(this.item.already_liked);
            this.$emit('like',{
                id: this.item.id,
                liked: this.item.already_liked,
            })
        }
    },
}
</script>

<style lang="scss">

    .card-wrapper {
        
        width: 100% !important;
        height: 100% !important;

        position: absolute;
        bottom: 0;
    
    
        background-image: linear-gradient(rgba(58,66,66,0.0), rgba(58,66,66,0.2), rgba(58,66,66,0.7), rgba(58,66,66,0.8));
        .name{
            position: absolute;
            bottom: 0;
        }
    }

    .button__liked{
        color: red !important;
    }

    .barName{
        color: white !important;
    }

    .row{
        margin: 0;
    }




</style>