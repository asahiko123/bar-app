<template>
    <v-card>            
        <v-card-actions class="justify-start">    
            <v-btn
            text
            @click="onSelectBar()">
                <div class="barinfo">
                    <p class="text-vuetify barlist">{{ this.barName }}</p>
                    <p class="text-vuetify barAddress">{{ this.barAddress}}</p>
                </div>
            </v-btn>

        </v-card-actions>
    </v-card>
</template>

<script>
// import newPost from '../../newPost';
import store from "../../store";

export default{

    name: 'BarList',

    props:{
        barName: String,
        barAddress: String
    },

    methods:{

        onSelectBar(){

            // newPost.onSelectBar();
            store.commit('data/setBarName',this.barName);
            store.commit('data/setDialog',false);
        }

    }
}
</script>

<style scoped>

.justify-start{
    height: 100%;
}
.barinfo{
    display: flex;
    flex-flow: column;
    width: 100%;
}

.text-vuetify{
    margin-bottom: 0px;
}

.barlist{
    font-weight: bold;
    text-align: left;
}

.barAddress{
    color:darkgrey;
}
</style>